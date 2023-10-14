<?php
require_once('../../includes/db_connection.php');

// Fetch data grouped by anime title, along with the associated photo
$query = "SELECT a.title, SUM(a.total_ratings_by_user) AS total_ratings_by_users, SUM(a.total_rating) AS total_rating, b.photo,
                 AVG(a.total_rating / a.total_ratings_by_user) AS average_rating
          FROM anime_ratings a
          LEFT JOIN anime_details_insert b ON a.anime_id = b.id
          GROUP BY a.title";
$result = $conn->query($query);

if ($result === false) {
    die("Error retrieving anime ratings: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Anime Ratings</title>
    <link rel="stylesheet" type="text/css" href="../../css/anime_ratings.css">
</head>
<body>
    <div class="anime-ratings">
        <h1>Anime Ratings</h1>
        <table>
            <thead>
                <tr>
                    <th>Anime Title</th>
                    <th>Photo</th>
                    <th>Total Ratings by Users</th>
                    <th>Total Rating</th>
                    <th>Average Rating</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['title']; ?></td>
                        <td>
                            <?php if ($row['photo']) : ?>
                                <img src="../../<?php echo $row['photo']; ?>" class="anime-photo" alt="Anime Photo">
                            <?php else : ?>
                                No Photo Available
                            <?php endif; ?>
                        </td>
                        <td><?php echo $row['total_ratings_by_users']; ?></td>
                        <td><?php echo $row['total_rating']; ?></td>
                        <td><?php echo number_format($row['average_rating'], 2); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
