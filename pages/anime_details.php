<?php
require_once('includes/db_connection.php');

// Fetch anime details from the database
$query = "SELECT * FROM anime_details_insert";
$result = $conn->query($query);

if ($result === false) {
    die("Error retrieving anime details: " . $conn->error);
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Anime Details</title>
    <link rel="stylesheet" type="text/css" href="css/user_anime_details.css">
    <link rel="icon" type="image/png" href="images/logo-image.png">
</head>
<body>
    <h1 class="anime-details-title">Anime Details</h1>
    <div class="anime-details-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="anime-card">
                <?php if ($row['photo']) : ?>
                    <img class="anime-photo" src="<?php echo $row['photo']; ?>" alt="<?php echo $row['title']; ?>">
                <?php endif; ?>
                <h2 class="anime-title"><?php echo $row['title']; ?></h2>
                <div class="anime-description">Synopsis: <?php echo $row['description']; ?></div>
                <p class="anime-aired-date">Aired Date: <?php echo $row['aired_date']; ?></p>
                <form action="user/submit_rating.php" method="post">
                    <input type="hidden" name="anime_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="anime_title" value="<?php echo $row['title']; ?>">
                    <input type="number" name="rating" min="1" max="5" required>
                    <input type="submit" value="Submit Rating">
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
