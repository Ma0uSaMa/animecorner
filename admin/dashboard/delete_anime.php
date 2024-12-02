<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    echo "Admin not logged in";
    // Optionally, redirect to the admin login page
    // header("Location: ../admin_login.php");
    // exit();
}

require_once('../../includes/db_connection.php');

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $anime_id = $_GET['id'];

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Delete related rows from the anime_ratings table
        $delete_ratings_query = "DELETE FROM anime_ratings WHERE anime_id = ?";
        $stmt_ratings = $conn->prepare($delete_ratings_query);
        $stmt_ratings->bind_param("i", $anime_id);

        if (!$stmt_ratings->execute()) {
            throw new Exception("Failed to delete ratings: " . $stmt_ratings->error);
        }

        $stmt_ratings->close();

        // Delete the anime from the anime_details_insert table
        $delete_anime_query = "DELETE FROM anime_details_insert WHERE id = ?";
        $stmt_anime = $conn->prepare($delete_anime_query);
        $stmt_anime->bind_param("i", $anime_id);

        if (!$stmt_anime->execute()) {
            throw new Exception("Failed to delete anime: " . $stmt_anime->error);
        }

        $stmt_anime->close();

        // Commit the transaction
        $conn->commit();

        // Redirect back to the anime details page
        header("Location: dashboard.php?page=anime_details");
        exit();
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        echo "Error occurred: " . $e->getMessage();
    }
} else {
    // 'id' parameter not set in the URL
    echo "Anime ID not provided in the URL.";
}

// Close the database connection
$conn->close();
?>
