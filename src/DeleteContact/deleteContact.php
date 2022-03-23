<?php

//Authentication
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] == "false") {
    header("Location: ./../Login/login.php");
    exit();
}
require_once("./../contactHandler.php");
require_once("./../db_models.php");

$contactManager = new ContactManager();
if(isset($_POST['deleteId'])) {

    $contactManager->deleteContact($_POST['deleteId']);
    header("Location: ./../allContacts/allContacts.php");
    exit();
} 
