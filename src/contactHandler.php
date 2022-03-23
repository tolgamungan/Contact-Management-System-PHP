<?php

require_once("db_models.php");

class ContactManager {
    private $tableName;
    private $connection;
    private $config;

    public function __construct() {
        $this->config = parse_ini_file( $_SERVER['DOCUMENT_ROOT']."/cms/config.ini");
        //database table name
        $this->tableName = "contact";
        //MySQL connection and selectting the database to use
        $this->connection = mysqli_connect($this->config['servername'], $this->config['username'], $this->config['password']) 
            or die(mysqli_error($this->connection));
    }
    
    public function getAllContacts() { // for allContacts
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $sql = "SELECT * FROM $this->tableName ORDER BY id";
        $result = @mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $allContacts = array();

        while ($row = mysqli_fetch_array($result)) {
            $contact = new Contact;
            $contact->id             = $row['id'];
            $contact->firstName      = $row['firstName'];
            $contact->lastName       = $row['lastName'];
            $contact->emailAddress   = $row['emailAddress'];
            $contact->phoneNumber    = $row['phoneNumber'];
            $contact->birthday       = $row['birthday'];
            $contact->streetAddress  = $row['streetAddress'];
            $contact->city           = $row['city'];
            $contact->province       = $row['province'];
            $contact->postalCode     = $row['postalCode'];

            array_push($allContacts, $contact);
        } return $allContacts;
    }

    public function getContactById($id) { // for editContact
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $statement = $this->connection->prepare("SELECT * FROM $this->tableName WHERE id = ? LIMIT 1");
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();

        if($result->num_rows != 1) {
            return false;
        } else {
            $result->data_seek(0);
            $row = $result->fetch_assoc();
            $contact = new Contact;
            $contact->id             = $row['id'];
            $contact->firstName      = $row['firstName'];
            $contact->lastName       = $row['lastName'];
            $contact->emailAddress   = $row['emailAddress'];
            $contact->phoneNumber    = $row['phoneNumber'];
            $contact->birthday       = $row['birthday'];
            $contact->streetAddress  = $row['streetAddress'];
            $contact->city           = $row['city'];
            $contact->province       = $row['province'];
            $contact->postalCode     = $row['postalCode'];            
        } return $contact;
    }

    public function getContactsBySearch($search) { // for search feature
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $sql = "SELECT * FROM $this->tableName WHERE firstName like '%$search%' OR lastName like '%$search%' ORDER BY id";
        $result = @mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $allContacts = array();

        while ($row = mysqli_fetch_array($result)) {
            $contact = new Contact;
            $contact->id             = $row['id'];
            $contact->firstName      = $row['firstName'];
            $contact->lastName       = $row['lastName'];
            $contact->emailAddress   = $row['emailAddress'];
            $contact->phoneNumber    = $row['phoneNumber'];
            $contact->birthday       = $row['birthday'];
            $contact->streetAddress  = $row['streetAddress'];
            $contact->city           = $row['city'];
            $contact->province       = $row['province'];
            $contact->postalCode     = $row['postalCode'];

            array_push($allContacts, $contact);
        } return $allContacts;
    }
    public function getContactsBirthdayBySearch($search) { // for calendar search feature
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $sql = "SELECT * FROM $this->tableName WHERE firstName like '%$search%' OR lastName like '%$search%' ORDER BY CONCAT(SUBSTR(`birthday`,6) < SUBSTR(CURDATE(),6), SUBSTR(`birthday`,6))";
        $result = @mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $allContacts = array();

        while ($row = mysqli_fetch_array($result)) {
            $contact = new Contact;
            $contact->id             = $row['id'];
            $contact->firstName      = $row['firstName'];
            $contact->lastName       = $row['lastName'];
            $contact->emailAddress   = $row['emailAddress'];
            $contact->phoneNumber    = $row['phoneNumber'];
            $contact->birthday       = $row['birthday'];
            $contact->streetAddress  = $row['streetAddress'];
            $contact->city           = $row['city'];
            $contact->province       = $row['province'];
            $contact->postalCode     = $row['postalCode'];

            array_push($allContacts, $contact);
        } return $allContacts;
    }
    public function getContactsByBirthday() { // for calendar
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $sql = "SELECT * FROM $this->tableName ORDER BY CONCAT(SUBSTR(`birthday`,6) < SUBSTR(CURDATE(),6), SUBSTR(`birthday`,6))";
        $result = @mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $allContacts = array();
        while ($row = mysqli_fetch_array($result)) {
            $contact = new Contact;
            $contact->id             = $row['id'];
            $contact->firstName      = $row['firstName'];
            $contact->lastName       = $row['lastName'];
            $contact->emailAddress   = $row['emailAddress'];
            $contact->phoneNumber    = $row['phoneNumber'];
            $contact->birthday       = $row['birthday'];
            $contact->streetAddress  = $row['streetAddress'];
            $contact->city           = $row['city'];
            $contact->province       = $row['province'];
            $contact->postalCode     = $row['postalCode'];

            array_push($allContacts, $contact);
        } return $allContacts;
    }

    public function getAllContactsEmail() { // for sending emails
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $sql = "SELECT emailAddress FROM $this->tableName ORDER BY id";
        $result = @mysqli_query($this->connection, $sql) or die(mysqli_error($this->connection));
        $emailArray = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($emailArray, $row['emailAddress']);
        } return $emailArray;
    }

    public function saveContact($contact) { // for addContact
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $statement = $this->connection->prepare("INSERT INTO $this->tableName (firstName, lastName, emailAddress, phoneNumber, birthday, streetAddress, city, province, postalCode) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->bind_param('sssssssss', $contact->firstName, $contact->lastName, $contact->emailAddress, $contact->phoneNumber, $contact->birthday, $contact->streetAddress, $contact->city, $contact->province, $contact->postalCode);
        $statement->execute();
        return True;
    }

    public function updateContact($contact, $id) { // for editContact
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $statement = $this->connection->prepare("UPDATE $this->tableName SET firstName = ?, lastName = ?, emailAddress = ?, phoneNumber = ?, birthday = ?, streetAddress = ?, city = ?, province = ?, postalCode = ? WHERE id = ?");
        $statement->bind_param('sssssssssi', $contact->firstName, $contact->lastName, $contact->emailAddress, $contact->phoneNumber, $contact->birthday, $contact->streetAddress, $contact->city, $contact->province, $contact->postalCode, $id);
        $statement->execute();
        return True;
    }

    public function deleteContact($id) { // for deleteContact
        $db = @mysqli_select_db($this->connection, $this->config['dbname']) or die(mysqli_error($this->connection));
        $statement = $this->connection->prepare("DELETE FROM $this->tableName WHERE id = ?");
        $statement->bind_param('i', $id);
        $statement->execute();
        return True;
    }
    
}
