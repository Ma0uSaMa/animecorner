<?php
session_start();
require_once('../includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $anime_id = $_POST['anime_id'];
    $rating = $_POST['rating'];

    $query = "INSERT INTO ratings (anime_id, rating) VALUES (?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error preparing SQL statement: " . $conn->error);
    }

    $stmt->bind_param("ii", $anime_id, $rating);

    if ($stmt->execute()) {
        $_SESSION['anime_message'] = "Rating submitted successfully.";
    } else {
        $_SESSION['anime_message'] = "Error submitting rating: " . $stmt->error;
    }

    header("Location: user_anime_details.php");
    exit();
} else {
    $_SESSION['anime_message'] = "Invalid request method.";
    header("Location: user_anime_details.php");
    exit();
}

$conn->close();
?>
 