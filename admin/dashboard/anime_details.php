<?php
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admin_login.php");
    exit();
}

require_once('../../includes/db_connection.php');

// Fetch anime details from the database
$query = "SELECT * FROM anime_details_insert";
$result = $conn->query($query);

if ($result === false) {
    die("Error retrieving anime details: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Anime Details</title>
    <link rel="stylesheet" type="text/css" href="../../css/anime_details.css">
    <link rel="icon" type="image/png" href="../../images/logo-image.png">
</head>
<body>
    <h1 class="anime-details-title">Anime Details</h1>
    <div class="anime-details-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="anime-card">
                <h2 class="anime-title"><?php echo $row['title']; ?></h2>
                <p class="anime-description"><?php echo $row['description']; ?></p>
                <p class="anime-aired-date">Aired Date: <?php echo $row['aired_date']; ?></p>
                <?php if ($row['photo']) : ?>
                    <img class="anime-photo" src="<?php echo $row['photo']; ?>" alt="<?php echo $row['title']; ?>">
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
