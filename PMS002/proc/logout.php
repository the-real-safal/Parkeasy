<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['email'])) {
// remove all session variables
session_unset(); 

}
header("Location: ../index.php"); // Redirecting To Home Page
?>