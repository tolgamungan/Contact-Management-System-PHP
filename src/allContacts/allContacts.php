<?php

// Authentication
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] == "false") {
    header("Location: ./../login.html");
    exit();
}
require_once("./../contactHandler.php");

$contactManager = new ContactManager();

 if(isset($_POST['search']) && $_POST['search'] != "") {
    $allContacts = $contactManager->getContactsBySearch($_POST['search']);    
    } else { $allContacts = $contactManager->getAllContacts(); 
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Contact Manager</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>
	<body>

        <header>
            <div class=" container">
                <nav class="navbar navbar-expand navbar-light">
                    <a class="navbar-brand mx-5" href="#">Contact Management System</a>
                    
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav mx-5">
                            <a class="nav-item nav-link active" href="./../allContacts/allContacts.php">Contacts</a>
                            <a class="nav-item nav-link" href="./../Calendar/calendar.php">Calendar</a>
                            <a class="nav-item nav-link btn btn-danger btn-sm mx-5" href="./../Logout/logout.php">Logout</a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
            <nav class="navbar navbar-expand navbar-light">

                <a class="navbar-brand " href="#"></a>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link active btn btn-warning mx-3" href="./../SendEmail/emailForm.php">Email</a>
                        <a class="nav-item nav-link active btn btn-warning mx-3" href="./../CSV/exportData.php">Export Data</a>
                        <a class="nav-item nav-link active btn btn-warning mx-3" href="./../CSV/importData.php">Import Data</a>
                        <a class="nav-item nav-link active btn btn-warning mx-3" href="./../AddContact/addContact.php">Add New</a>
                    </div>
                </div>

            </nav>
        </div>

        <div class="container ">
        <form action="allContacts.php" method="POST" class="container mt-0">
            <input type="text" name="search" id="search" class="w-75 search-bar text-dark border-0 text-center" placeholder="Search a contact" />
            <input type="submit" class="w-25 btn btn-primary m-3" value="Search" />
            </form>
        </div>
        
        <div class="container">
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
            <link rel="stylesheet" href="./../../wwwroot/css/site.css">
            <div class="container">

                <div class="table-responsive">
                    <table class="table user-list">
                        <?php if(!empty($allContacts)) { ?>
                            <thead>
                                <tr>
                                    <th><span>Name</span></th>
                                    <th><span>Phone</span></th>
                                    <th class="text-center"><span>Email</span></th>
                                    <th class="text-center"><span>Birthday</span></th>
                                    <th class="text-center"><span>Address</span></th>
                                    <th><span>Edit/Delete</span></th>
                                </tr>
                                
                            </thead id="userData">
                            <tbody>
                        <?php if(!empty($allContacts)) foreach($allContacts as $k => $contact) { ?>

                            <tr>

                                <td><a href="#" class="user-link">
                                    <?php echo $contact->firstName ?>
                                    <?php echo $contact->lastName ?>
                                </a></td>

                                <td> <?php echo $contact->phoneNumber ?> </td>
                                
                                <td> <a href="#"> <?php echo $contact->emailAddress ?> </a></td>

                                <td class="text-center">
                                    <span class="label label-default"><?php echo $contact->birthday ?></span>
                                </td>
                                
                                <td class="text-center">
                                    <span class="label label-default">
                                        <?php echo $contact->streetAddress ?>
                                        <?php echo $contact->city ?>
                                        <?php echo $contact->province ?>
                                        <?php echo $contact->postalCode ?>
                                    </span>
                                </td>
                                
                                <td>
                                    <form action="./../EditContact/editContact.php" method="post">
                                        <button class="btn btn-sm btn-success" type="submit" name="editId" value="<?php echo $contact->id ?>">Edit</button>
                                    </form>
                                    <form action="./../DeleteContact/deleteContact.php" method="post">
                                        <button class="btn btn-sm btn-danger" type="submit" name="deleteId" value="<?php echo $contact->id ?>">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                            <div class="h3">No records to display</div>
                        <?php } ?>
            </div>
        </div>
    </body>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="./../../wwwroot/js/site.js"></script>
</html>
