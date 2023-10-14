<?php
require_once('includes/db_connection.php');

// Calculate the average ratings for each anime
$query = "SELECT title, AVG(total_rating / total_ratings_by_user) AS avg_rating
          FROM anime_ratings
          GROUP BY title
          HAVING COUNT(user_id) >= 5";

$result = $conn->query($query);

if ($result === false) {
    die("Error retrieving anime data: " . $conn->error);
}

$animeData = [];
while ($row = $result->fetch_assoc()) {
    $animeData[$row['title']] = $row['avg_rating'];
}

// Calculate the Bayesian average rating and retrieve the top 10 trending anime
$query = "SELECT title
          FROM anime_ratings
          GROUP BY title
          HAVING COUNT(user_id) >= 5
          ORDER BY (
              (SUM(total_rating) / SUM(total_ratings_by_user)) * 5 +
              (AVG(total_rating / total_ratings_by_user)) * 5
          ) DESC
          LIMIT 10";

if (!empty($animeData)) {
    $averageBayesian = array_sum($animeData) / count($animeData);
} else {
    $averageBayesian = 0; // Default value if there are no anime records
}

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    die("Error retrieving trending anime: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Top Trending Anime</title>
    <link rel="stylesheet" type="text/css" href="css/trending_anime.css">
</head>
<body>
    <div class="trending-anime">
        <h1>Top Trending Anime</h1>
        <div class="card-container">
            <?php
            $rank = 1; // Initialize the rank
            while ($row = $result->fetch_assoc()) :
                $animeTitle = $row['title'];
                $animeTitleQuery = "SELECT title, photo FROM anime_details_insert WHERE title = ?";
                $stmt = $conn->prepare($animeTitleQuery);
                $stmt->bind_param("s", $animeTitle);
                $stmt->execute();
                $stmt->bind_result($animeTitle, $animePhoto);
                $stmt->fetch();
                $stmt->close();
            ?>
                <div class="card">
                    <div class="card-image">
                        <img src="<?php echo $animePhoto; ?>" alt="<?php echo $animeTitle; ?>">
                    </div>
                    <div class="card-content">
                        <h2><?php echo $animeTitle; ?></h2>
                        <p>Rank: <?php echo $rank; ?></p> <!-- Display the rank -->
                        <p>Average Rating: <?php echo number_format($animeData[$animeTitle], 2); ?></p>
                        <p>Total Ratings by Users: <?php echo getTotalRatingsByUsers($animeTitle, $conn); ?></p>
                    </div>
                </div>
            <?php
                $rank++; // Increment the rank for the next anime
            endwhile;
            
            // Function to get the total ratings by users for an anime
            function getTotalRatingsByUsers($animeTitle, $conn) {
                $query = "SELECT SUM(total_ratings_by_user) AS total_ratings FROM anime_ratings WHERE title = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $animeTitle);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['total_ratings'];
            }
            ?>
        </div>
    </div>
</body>
</html>
