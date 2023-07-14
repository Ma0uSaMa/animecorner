<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anime_corner";

// Create a database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
