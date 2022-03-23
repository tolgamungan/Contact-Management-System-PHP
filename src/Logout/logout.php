<?php 
session_start();
session_unset();
// Destroy the session.
session_destroy();
// Clear Session cookie
unset($_COOKIE['PHPSESSID']);
setcookie("PHPSESSID", "", time()-3600, "/");
header("Location: ./../Login/login.php");
exit();
?>