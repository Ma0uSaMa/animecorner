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
    <title>Publish Anime</title>
    <link rel="stylesheet" type="text/css" href="../../css/publish_anime.css">
    <link rel="icon" type="image/png" href="../../images/logo-image.png">
</head>
<body>
    <h1 class="publish-anime-title">Publish Anime</h1>
    <form class="publish-anime-form" action="../auth/anime_dbinsert.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="date" name="aired_date" required>
        <input type="file" name="photo" accept="image/*" required>
        <input type="submit" value="Publish">
    </form>
    <div class="publish-anime-message">
        <?php
        if (isset($_SESSION['anime_message'])) {
            echo $_SESSION['anime_message'];
            unset($_SESSION['anime_message']);
        }
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/publish_anime.js"></script>
</body>
</html>
