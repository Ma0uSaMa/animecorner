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
    $query = "INSERT INTO anime_details_insert (title, description, aired_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error preparing SQL statement: " . $conn->error);
    }

    $stmt->bind_param("sss", $title, $description, $aired_date);

    if ($stmt->execute()) {
        $anime_id = $stmt->insert_id;

        // Validate the uploaded photo
        $photo = $_FILES['photo'] ?? null;
        if ($photo === null || $photo['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['anime_message'] = "Error uploading the photo.";
            header("Location: publish_anime.php");
            exit();
        }

        $photo_name = $photo['name'];
        $photo_tmp = $photo['tmp_name'];
        $photo_size = $photo['size'];
        $photo_error = $photo['error'];

        // Define the supported image formats
        $supported_formats = ['image/png', 'image/jpeg', 'image/gif'];

        // Check if the uploaded file is an image and of a supported format
        $image_info = getimagesize($photo_tmp);
        if ($image_info !== false && in_array($image_info['mime'], $supported_formats)) {
            // Move the uploaded photo to the desired location
            $photo_path = "../../images/anime_photos/" . $anime_id . '_' . $photo_name;
            move_uploaded_file($photo_tmp, $photo_path);

            // Update the anime record with the photo path
            $update_query = "UPDATE anime_details_insert SET photo = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);

            if ($update_stmt === false) {
                die("Error preparing SQL statement: " . $conn->error);
            }

            $update_stmt->bind_param("si", $photo_path, $anime_id);

            if ($update_stmt->execute()) {
                $_SESSION['anime_message'] = "Anime details inserted successfully.";
                header("Location: ../dashboard/dashboard.php?page=publish_anime");
                exit();
            } else {
                $_SESSION['anime_message'] = "Error updating anime details: " . $update_stmt->error;
                header("Location: ../dashboard/dashboard.php?page=publish_anime");
                exit();
            }
        } else {
            $_SESSION['anime_message'] = "Invalid file format. Only PNG, JPG, and GIF images are allowed.";
            header("Location: ../dashboard/dashboard.php?page=publish_anime");
            exit();
        }
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
