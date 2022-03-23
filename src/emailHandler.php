<?php

// Authentication
session_start();
if(!isset($_SESSION['auth']) || $_SESSION['auth'] == "false") {
    header("Location: ./../Login/login.php");
    exit();
}
require_once("./csvHandler.php");
// SMTP server and port
ini_set('SMTP','myserver');
ini_set('smtp_port',25);

if (($_POST['sender_name'] == "") || ($_POST['sender_email'] == "") || ($_POST['message'] == "")) {
    header("Location: ./../allContacts/allContacts.php");
    exit;
}
$contactManager = new ContactManager();
$emails = $contactManager->getAllContactsEmail();
$emailTo = implode(",", $emails);

function sendMail($to, $msg) {
    $msg = "E-MAIL SENT FROM \"it.nscctruro.ca\"\n";
    $msg .= "Sender's E-Mail:\t$_POST[sender_email]\n";
    $msg .= "Message:\t$_POST[message]\n";
    $subject = "Web Site Feedback";
    $mailheaders = "From: My Web Site <webmaster@nscctruro.ca>\n";
    $mailheaders .= "Reply-To: $_POST[sender_email]\n";
    mail($to, $subject, $msg, $mailheaders);
}
sendMail($emailTo, $_POST['message']);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Emails Sent</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <h1>The following e-mail has been sent:</h1>
        <p><strong>Your Name:</strong><br>
        <?php echo "$_POST[sender_name]"; ?>
        <p><strong>Your E-Mail Address:</strong><br>
        <?php echo "$_POST[sender_email]"; ?>
        <p><strong>Message:</strong><br>
        <?php echo "$_POST[message]"; ?>
    </body>
</html>