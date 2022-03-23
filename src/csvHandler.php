<?php

require("db_models.php");
require("contactHandler.php");

class CSVManager {
    public $exportFilepath = "./../../documents/filesExported/";
    public $importFilepath = "./../../documents/filesImported/";
    private $contactManager;

    public function __construct() {
        $this->contactManager = new ContactManager;
    }
    public function import($filename) {
        $file = @fopen($this->importFilepath.$filename, "r") or die("Couldn't open file");
        
        // Create Contact objects
        while (($line = fgetcsv($file)) !== FALSE) {
            if(!empty($line) && isset($line[1])) {
                $contact = new Contact;
                $contact->firstName      = $line[0];
                $contact->lastName       = $line[1];
                $contact->emailAddress   = $line[3];
                $contact->phoneNumber    = $line[2];
                $contact->birthday       = $line[8];
                $contact->streetAddress  = $line[4];
                $contact->city           = $line[5];
                $contact->province       = $line[6];
                $contact->postalCode     = $line[7];

                $this->contactManager->saveContact($contact);
            }
        } fclose($file);
    }

    public function export($filename) {
        $allContacts = $this->contactManager->getAllContacts();

        // Export CSV data
        $file = @fopen($this->exportFilepath.$filename, "w") or die("Couldn't create file."); // note die() & @ for error suppression            
        foreach ($allContacts as $key => $contact) {
            $data = array(  
                            $contact->firstName, 
                            $contact->lastName, 
                            $contact->phoneNumber, 
                            $contact->emailAddress, 
                            $contact->streetAddress, 
                            $contact->city, 
                            $contact->province, 
                            $contact->postalCode, 
                            $contact->birthday 
                        );
            fputcsv($file, $data);
        } fclose($file);

        // Return file to the browser
        $attachment_location = $this->exportFilepath.$filename;
        if (file_exists($attachment_location)) {

            header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
            header("Cache-Control: public");            
            header("Content-Type: text/csv");
            header("Content-Transfer-Encoding: Binary");
            header("Content-Length:".filesize($attachment_location));
            header("Content-Disposition: attachment; filename=contactInfo.csv");
            readfile($attachment_location);
            die();        
        } else { die("Error: File not found."); } 
    }
    
}
