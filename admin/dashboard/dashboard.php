<?php
session_start();

if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admin_login.php");
    exit();
}
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
    <?php include __DIR__ . '/../../partials/dashboard_navbar.php'; ?>
    <?php include __DIR__ . '/../../partials/dashboard_sidebar.php'; ?>
    <section class="home">
        <div class="text">Dashboard</div>
        
        <?php
        // Check if the 'registered' parameter is set in the URL
        if (isset($_GET['registered']) && $_GET['registered'] === 'users') {
            include __DIR__ . '/registered_users.php';
        }
        ?>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Attach a click event listener to the "Registered Users" link
    $('#registered-users-link').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('.home').load('../../admin/dashboard/registered_users.php'); // Load the content of registered_users.php into the .home section
    });
});
</script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/registered_users.js"></script>
    <script src="../../js/dashboard.js"></script>
</body>
</html>
