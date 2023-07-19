<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admin_login.php");
    exit();
}

// Get the current page from the URL parameter
$page = $_GET['page'] ?? 'dashboard';

// Define the page titles and corresponding file names
$pages = array(
    'dashboard' => 'Dashboard',
    'registered_users' => 'Registered Users',
    'publish_anime' => 'Publish Anime',
    'anime_details' => 'Anime Details'
);

// Get the page title based on the current page
$pageTitle = isset($pages[$page]) ? $pages[$page] : 'Dashboard';

// Define the file path based on the current page
$filePath = ($page !== 'dashboard') ? __DIR__ . '/' . $page . '.php' : '';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../css/dashboard_navbar.css">
    <link rel="stylesheet" type="text/css" href="../../css/dashboard_sidebar.css">
    <link rel="icon" type="image/png" href="../../images/logo-image.png">
</head>
<body>
    <?php include __DIR__ . '/../../partials/dashboard_sidebar.php'; ?>
    <?php include __DIR__ . '/../../partials/dashboard_navbar.php'; ?>

    <section class="home">
       <?php
        // Check if the 'page' parameter is set in the URL
        if (isset($_GET['page'])) {
            // Get the page name from the 'page' parameter
            $page = $_GET['page'];

            // Define the file path based on the current page
            $filePath = __DIR__ . '/' . $page . '.php';

            // Include the content based on the current page
            if (file_exists($filePath)) {
                include $filePath;
            } else {
                echo '<p>Page not found.</p>';
            }
        }
        ?>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/dashboard_sidebar.js"></script>
</body>
</html>
