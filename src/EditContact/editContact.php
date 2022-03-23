<?php

// Authentication
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] == "false") {
    header("Location: login.php");
    exit();
}
require_once("./../contactHandler.php");
require_once("./../db_models.php");

$contactManager = new ContactManager();
if(isset($_POST['editId'])) {
    $contact = $contactManager->getContactById($_POST['editId']);
} else if(isset($_POST['id'])) {

    var_dump($_POST);

    if(isset($_POST['id']) && isset($_POST['firstName']) && isset($_POST['lastName'])
        && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['birthday'])
        && isset($_POST['streetAddress']) && isset($_POST['city']) && isset($_POST['province']) && isset($_POST['postalCode'])) {

        $contact = $contactManager->getContactById($_POST['id']);
        $contact->firstName      = $_POST['firstName'];
        $contact->lastName       = $_POST['lastName'];
        $contact->emailAddress   = $_POST['email'];
        $contact->phoneNumber    = $_POST['phone'];
        $contact->birthday       = $_POST['birthday'];
        $contact->streetAddress  = $_POST['streetAddress'];
        $contact->city           = $_POST['city'];
        $contact->province       = $_POST['province'];
        $contact->postalCode     = $_POST['postalCode'];

        $contactManager->updateContact($contact, $_POST['id']);
        header("Location: ./../allContacts/allContacts.php");
        exit();
    } else {
        $error = "Some information is missing. Please fill all the fields.";
    }
} else {
    header("Location: ./../allContacts/allContacts.php");
    exit();
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
        <div class="ms-auto me-auto" style="min-width: 300px; max-width: 500px">
            <div class="mx-4">

                <div class="my-4">
                    <h1>Edit Contact</h1>
                </div>
                <form action="editContact.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $contact->id; ?>">

                        <div class="form-group mt-2">
                            <label class="form-label" for="firstName">First Name</label>
                            <input class="form-control" type="text" name="firstName" maxlength=100 required value="<?php echo $contact->firstName; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="lastName">Last Name</label>
                            <input class="form-control" type="text" name="lastName" maxlength=100 required value="<?php echo $contact->lastName; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" maxlength=255 required value="<?php echo $contact->emailAddress; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="phone">Phone</label>
                            <input class="form-control" type="text" name="phone" pattern="[0-9]-[0-9]{3}-[0-9]{3}-[0-9]{4}" maxlength=14 required value="<?php echo $contact->phoneNumber; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="birthday">Birthday</label>
                            <input class="form-control" type="date" name="birthday" min="1940-01-01" max="<?= date('Y-m-d'); ?>" required value="<?php echo $contact->birthday; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="streetAddress">Street Address</label>
                            <input class="form-control" type="tel" name="streetAddress" maxlength=512 required value="<?php echo $contact->streetAddress; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="city">City</label>
                            <input class="form-control" type="text" name="city" maxlength=100 required value="<?php echo $contact->city; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="province">Province</label>
                            <input class="form-control" type="text" name="province" maxlength=100 required value="<?php echo $contact->province; ?>">
                        </div>

                        <div class="form-group mt-2">
                            <label class="form-label" for="postalCode">Postal Code</label>
                            <input class="form-control" type="text" name="postalCode" maxlength=10 required value="<?php echo $contact->postalCode; ?>">
                        </div>

                        <div class="form-group my-3">
                            <input class="btn btn-success" type="submit" value="Submit">
                        </div>
                 </form>

                <div class="text-danger"><?php if(isset($error)) echo $error; ?></div>
            </div>
        </div>
    </body>
</html>