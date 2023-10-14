<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    echo "Admin not logged in"; // Debugging message
    // You can redirect to the admin login page here if needed
    // header("Location: ../admin_login.php");
    // exit();
}

require_once('../../includes/db_connection.php');

// Check if 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    // Get the 'id' parameter from the URL
    $anime_id = $_GET['id'];

    // SQL query to delete the anime based on the 'id'
    $delete_query = "DELETE FROM anime_details_insert WHERE id = ?";
    
    // Prepare and execute the delete query
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $anime_id);
    
    if ($stmt->execute()) {
        // Anime successfully deleted
        // Redirect back to anime_details.php
        header("Location: dashboard.php?page=anime_details");
        exit();
    } else {
        // Error occurred during deletion
        echo "Error deleting anime with ID $anime_id: " . $conn->error;
    }
    
    $stmt->close();
} else {
    // 'id' parameter not set in the URL
    echo "Anime ID not provided in the URL.";
}

$conn->close();
?>
