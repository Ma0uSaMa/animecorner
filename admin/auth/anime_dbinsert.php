<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admin_login.php");
    exit();
}

require_once('../../includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input data
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $aired_date = $_POST['aired_date'] ?? '';

    // Prepare and execute the SQL statement to insert the anime details
    $query = "INSERT INTO anime_details_insert (title, description, aired_date, photo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error preparing SQL statement: " . $conn->error);
    }

    // Get the relative path of the uploaded photo
    $photo_path = '';

    $photo = $_FILES['photo'] ?? null;
    if ($photo === null || $photo['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['anime_message'] = "Error uploading the photo.";
        header("Location: publish_anime.php");
        exit();
    } else {
        // Define the supported image formats
        $supported_formats = ['image/png', 'image/jpeg', 'image/gif'];

        // Check if the uploaded file is an image and of a supported format
        $image_info = getimagesize($photo['tmp_name']);
        if ($image_info !== false && in_array($image_info['mime'], $supported_formats)) {
            // Move the uploaded photo to the desired location
            $photo_name = $photo['name'];
            $photo_path = "images/anime_photos/" . uniqid() . '_' . $photo_name;
            move_uploaded_file($photo['tmp_name'], "../../" . $photo_path);
        } else {
            $_SESSION['anime_message'] = "Invalid file format. Only PNG, JPG, and GIF images are allowed.";
            header("Location: publish_anime.php");
            exit();
        }
    }

    $stmt->bind_param("ssss", $title, $description, $aired_date, $photo_path);

    if ($stmt->execute()) {
        $_SESSION['anime_message'] = "Anime details inserted successfully.";
        header("Location: ../dashboard/dashboard.php?page=publish_anime");
        exit();
    } else {
        $_SESSION['anime_message'] = "Error inserting anime details: " . $stmt->error;
        header("Location: ../dashboard/dashboard.php?page=publish_anime");
        exit();
    }
} else {
    $_SESSION['anime_message'] = "Invalid request method.";
    header("Location: ../dashboard/dashboard.php?page=publish_anime");
    exit();
}

$conn->close();
?>
