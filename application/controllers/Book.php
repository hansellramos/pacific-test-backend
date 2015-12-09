<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Book
 * @author Hansel Ramos Osorio <hansell.ramos@gmail.com>
 * @desc This class is the books controller and contains all methods to read all books information
 */
class Book extends CI_Controller {

	/**
	 * Book constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('BookModel');
	}

	/**
	 * @desc This method shows a api documentation page with examples
	 */
	public function index()
	{
		$this->load->view('api');
	}

	/**
	 * @desc This method shows a upload form used to update a xml books database
	 */
	public function upload(){
		$this->load->view('upload');
	}

	/**
	 * @desc This method process a uploaded file with the upload method form and
	 * validate this uploaded file front to a xsd file in the upload folder
	 */
	public function do_upload(){
		$ud = dirname(__DIR__).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR;
		$config['upload_path'] = $ud.'temp'.DIRECTORY_SEPARATOR;
		$config['allowed_types'] = 'xml';
		$config['max_size']	= 1024*1024;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$document = new DOMDocument();
			$document->loadXML(file_get_contents($data['upload_data']['full_path']));
			if($document->schemaValidate(dirname(__DIR__).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'books.xsd')){
				$data['message'] = 'File successfully loaded';
				unlink($ud."books.xml");
				rename($data['upload_data']['full_path'],$ud."books.xml");
			}else{
				$xsdUrl = base_url('books.xsd');
				$data['error'] = "<span style='color: red'>Xml file not valid, please verify and try again, if need see xsd file must be downloaded from <a href='$xsdUrl' target='_blank'>$xsdUrl</a></span><br />";
			}

			$this->load->view('upload', $data);
		}
	}

	/**
	 * @desc This method shows all books information in json format
	 * @return bool Return false when a database file not exists or is empty
	 */
	public function all(){
		if(!$this->verifyFile()){return false;}
		$books = $this->BookModel->getAll();
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result'=>'ok','content'=>$books)));
	}

	/**
	 * @desc This method show all books filtered by language in json format
	 * @return bool Return false when a database file not exists or is empty
	 */
	public function lang(){
		if(!$this->verifyFile()){return false;}
		$param = $this->uri->segment(3);
		if($param!=""){
			if($param == "get"){
				$this->getLangs();
			}else{
				$this->output
						->set_content_type('application/json')
						->set_output(json_encode(array('result'=>'ok','content'=>$this->BookModel->getByLang($param))));
			}
		}
	}

	/**
	 * @desc This method show all books filtered by price compared over or less value in json format
	 * @return bool Return false when a database file not exists or is empty
	 */
	public function price(){
		if(!$this->verifyFile()){return false;}
		$comparision = $this->uri->segment(3);
		$param = $this->uri->segment(4);
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result'=>'ok','content'=>
						$this->BookModel->getByPrice($comparision, $param))));
	}

	/**
	 * @desc This method show all books filtered by quantity compared over or less value in json format
	 * @return bool Return false when a database file not exists or is empty
	 */
	public function quantity(){
		if(!$this->verifyFile()){return false;}
		$comparision = $this->uri->segment(3);
		$param = $this->uri->segment(4);
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result'=>'ok','content'=>
						$this->BookModel->getByQuantity($comparision, $param))));
	}

	/**
	 * @desc This method show languages in the books database in json format
	 * @return bool Return false when a database file not exists or is empty
	 */
	public function getLangs(){
		if(!$this->verifyFile()){return false;}
		$langs = $this->BookModel->getLangs();
		$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('result'=>'ok','content'=>$langs)));
	}

	/**
	 * @desc This method verify that a books database exists and is not empty
	 * @return bool Returns true if exists the books database and not empty, false if is empty or not exists
	 */
	private function verifyFile(){
		if(!$this->BookModel->isEmpty()){
			$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array('result'=>'fault','message'=>'No file found')));
			return false;
		}
		return true;
	}
}
