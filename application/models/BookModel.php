<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: hansellramos
 * Date: 12/9/15
 * Time: 3:00 AM
 * @desc This class manage all books information directly from a xml database
 */
class BookModel extends CI_Model
{
    /**
     * @var string Represents a books database file path to read
     */
    private $file;

    /**
     * BookModel constructor.
     */
    public function __construct()
    {
        $this->file = dirname(__DIR__).DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'books.xml';
        parent::__construct();
        $this->load->library('Xml2Array');
    }

    /**
     * @desc This method returns all books into xml database
     * @return Array_Object Returns an array with all books from xml books database
     */
    public function getAll(){
        return $this->xml2array->parse(file_get_contents($this->file))['Books']['Book'];
    }

    /**
     * @desc This method return all languages into a xml database
     * @return Array_Object Represents an array with all languages from xml database
     */
    public function getLangs(){
        $books = $this->getAll();
        $langs = array();
        foreach($books AS $book){
            if(!in_array($book['Language'],$langs)){
                $langs[] = $book['Language'];
            }
        }
        asort($langs);
        return $langs;
    }

    /**
     * @desc This method return all books filtered by language from a xml database
     * @param $lang Represents a language to filter all books from xml database
     * @return Array_Object Returns a books lists filtered by lang parameter
     */
    public function getByLang($lang){
        $books = $this->getAll();
        $results = array();
        foreach($books AS $book){
            if($book['Language'] == $lang){
                $results[] = $book;
            }
        }
        return $results;
    }

    /**
     * @desc This method return all books filtered by price from a xml database
     * @param $comparision Represents a comparision to use to filter all books from xml database
     * @param $value Represents a value to compare to filter all books from xml database
     * @return Array_Object Returns a books lists filtered by price parameter
     */
    public function getByPrice($comparision = 'over', $value=100){
        $books = $this->getAll();
        $results = array();
        foreach($books AS $book){
            if(
                ($comparision == 'over' && floatval($book['Price']) >= $value)
                || ($comparision == 'less' && floatval($book['Price']) <= $value)
            ){
                $results[] = $book;
            }
        }
        return $results;
    }

    /**
     * @desc This method return all books filtered by quantity from a xml database
     * @param $comparision Represents a comparision to use to filter all books from xml database
     * @param $value Represents a value to compare to filter all books from xml database
     * @return Array_Object Returns a books lists filtered by quantity parameter
     */
    public function getByQuantity($comparision = 'over', $value=100){
        $books = $this->getAll();
        $results = array();
        foreach($books AS $book){
            if(
                ($comparision == 'over' && intval($book['Quantity']) >= $value)
                || ($comparision == 'less' && intval($book['Quantity']) <= $value)
            ){
                $results[] = $book;
            }
        }
        return $results;
    }

    /**
     * @desc This method verify if a xml database exists or is not empty
     * @return bool Return true if a xml database is empty or not exists
     */
    public function isEmpty(){
         return file_exists($this->file);
    }

}