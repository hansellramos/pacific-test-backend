# pacific-test-backend

The developed files are:

    - controller/Books.php       (is the controller)
    - libraries/Xml2Array.php    (is a xml parser library used to process a xml database)
    - models/BookModel.php       (is a books model, this model reads a xml database)
    - views/
        api.php                  (is a api documentation web page)
        upload.php               (is a upload xml database view file)
        welcome_message.php      (is a presentation page)

Before use this web aplications must be configure a simple configuration file, only needs to change a
application/confir/config.php file in the line 26 and sets the url, dont needs configure any database,
this application reads the info directly from a xml database file located in application/upload/books.xml file
and the new xml database uploads files are validated before replace/update a old database, aditionaly must be set
a upload folder to 777 permissions, the php environment server should allow short php tags (<? ?>, <?= ?>)

Developed by Hansel Ramos, december 9th/ 2015
