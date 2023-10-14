<?php
require_once('includes/db_connection.php');

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

$queryHighest = "SELECT title
          FROM anime_ratings
          GROUP BY title
          HAVING COUNT(user_id) >= 5
          ORDER BY (
              (SUM(total_rating) / SUM(total_ratings_by_user)) * 5 +
              (AVG(total_rating / total_ratings_by_user)) * 5
          ) DESC
          LIMIT 1";

$queryLowest = "SELECT title
          FROM anime_ratings
          GROUP BY title
          HAVING COUNT(user_id) >= 5
          ORDER BY (
              (SUM(total_rating) / SUM(total_ratings_by_user)) * 5 +
              (AVG(total_rating / total_ratings_by_user)) * 5
          ) ASC
          LIMIT 1";

$stmtHighest = $conn->prepare($queryHighest);
$stmtHighest->execute();
$resultHighest = $stmtHighest->get_result();

$stmtLowest = $conn->prepare($queryLowest);
$stmtLowest->execute();
$resultLowest = $stmtLowest->get_result();

if ($resultHighest === false || $resultLowest === false) {
    die("Error retrieving highest and lowest-rated anime: " . $conn->error);
}

$highestRatedAnime = $resultHighest->fetch_assoc();
$lowestRatedAnime = $resultLowest->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Highest and Lowest Rated Anime</title>
    <link rel="stylesheet" type="text/css" href="../css/trending_anime.css">
</head>
<body>
    <div class="trending-anime">
        <h1>Highest and Lowest Rated Anime</h1>
        <div class="highest-rated">
            <h2>Highest Rated Anime</h2>
            <div class="card-container">
                <?php
                $animeTitle = $highestRatedAnime['title'];
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
                        <p>Average Rating: <?php echo number_format($animeData[$animeTitle], 2); ?></p>
                        <p>Total Ratings by Users: <?php echo getTotalRatingsByUsers($animeTitle, $conn); ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lowest-rated">
            <h2>Lowest Rated Anime</h2>
            <div class="card-container">
                <?php
                $animeTitle = $lowestRatedAnime['title'];
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
                        <p>Average Rating: <?php echo number_format($animeData[$animeTitle], 2); ?></p>
                        <p>Total Ratings by Users: <?php echo getTotalRatingsByUsers($animeTitle, $conn); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>