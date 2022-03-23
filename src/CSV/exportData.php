<?php
// Authentication
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] == "false") {
    header("Location: ./../Login/login.php");
    exit();
}
require_once("./../csvHandler.php");
$csvManager = new CSVManager();
$file = $csvManager->export("contacts-".time().".csv");



