<?php
session_start();

// Clear all session variables
$_SESSION = [];

// Destroy the session
session_destroy();

// Redirect to the login page or homepage
header("Location: ../home.php"); // Redirect to the login page
exit();
?>
