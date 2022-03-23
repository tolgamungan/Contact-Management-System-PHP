<?php

// Authentication
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] == "false") {
    header("Location: ./../Login/login.php");
    exit();
}
require_once("./../csvHandler.php");

if (isset($_FILES['file']) && $_FILES['file'] != "") {

    $csvManager = new CSVManager;
    
    // Check file type and size
    if ($_FILES["file"]["type"] != "text/csv") {
        $error = "Sorry, only CSV files can be imported.";
    } else if ($_FILES["file"]["size"] > 500000) {
        $error = "Sorry, your file is too large.";
    } else {
        copy($_FILES['file']['tmp_name'], $csvManager->importFilepath.$_FILES['file']['name']) or die("Couldn't copy the file.");
        $csvManager->import($_FILES['file']['name']);
        header("Location: ./../allContacts/allContacts.php");
        exit();
    }    
} 
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Import Data</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>
	<body>
        <div class="ms-auto me-auto" style="min-width: 300px; max-width: 500px">
            <div class="mx-4">
                <div class="my-4">
                    <h1>Import Data</h1>
                </div>

                <form action="importData.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="form-label" for="file">Upload CSV File</label>
                        <input class="form-control" type="file" name="file" required>
                    </div>

                    <div class="form-group my-3">
                        <input class="btn btn-success" type="submit" value="Submit">
                        <a class="btn btn-danger" href="./../allContacts/allContacts.php">Cancel</a>
                    </div>
                </form>

                <div class="text-danger"><?php if(isset($error)) echo $error; ?></div>

            </div>
        </div>
    </body>
</html>