<?php
session_start();
require_once('../includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to the login page or display a message asking the user to log in
        echo '<script>';
        echo 'alert("Please log in to rate anime.");';
        echo 'window.location.href="../home.php";';
        echo '</script>';
        exit();
    }

    $anime_id = $_POST['anime_id'];
    $anime_title = $_POST['anime_title'];
    $rating = $_POST['rating'];

    // Check if the user has already rated this anime
    $query = "SELECT COUNT(*) FROM anime_ratings WHERE anime_id = ? AND user_id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo '<script>';
        echo 'alert("Error preparing SQL statement.");';
        echo 'window.location.href="../home.php";';
        echo '</script>';
        exit();
    }

    $stmt->bind_param("ii", $anime_id, $_SESSION['user_id']);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // User has already rated this anime, redirect with a message
        echo '<script>';
        echo 'alert("You have already rated this anime.");';
        echo 'window.location.href="../home.php";';
        echo '</script>';
        exit();
    }

    // Insert the rating into the database
    $query = "INSERT INTO anime_ratings (anime_id, user_id, title, total_ratings_by_user, total_rating) VALUES (?, ?, ?, 1, ?)";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        echo '<script>';
        echo 'alert("Error preparing SQL statement.");';
        echo 'window.location.href="../home.php";';
        echo '</script>';
        exit();
    }

    $stmt->bind_param("iisd", $anime_id, $_SESSION['user_id'], $anime_title, $rating);

    if ($stmt->execute()) {
        // Display an alert for successful submission
        echo '<script>';
        echo 'alert("Rating submitted successfully for ' . htmlspecialchars($anime_title) . '");';
        echo 'window.location.href="../home.php?submitted_successfully=' . urlencode($anime_title) . '";';
        echo '</script>';
        exit();
    } else {
        // Handle the error, display a message, or redirect to an error page
        echo 'Error submitting rating: ' . $stmt->error;
    }

    $stmt->close();
}
?>
