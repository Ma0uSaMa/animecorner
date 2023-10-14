<?php
require_once('../includes/db_connection.php');

if (isset($_POST['searchTerm'])) {
    $searchTerm = $_POST['searchTerm'];

    // Prepare a query to search for anime titles matching the search term
    $query = "SELECT title, SUM(total_ratings_by_user) AS total_ratings_by_users, SUM(total_rating) AS total_rating, photo
              FROM anime_ratings
              LEFT JOIN anime_details_insert ON anime_ratings.anime_id = anime_details_insert.id
              WHERE title LIKE ?
              GROUP BY title";

    // Add '%' to the search term to perform a partial search
    $searchTermWithWildcards = '%' . $searchTerm . '%';

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $searchTermWithWildcards);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Output results
        while ($row = $result->fetch_assoc()) {
            echo '<div class="search-result">';
            echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
            echo '<p>Total Ratings by Users: ' . htmlspecialchars($row['total_ratings_by_users']) . '</p>';
            echo '<p>Total Rating: ' . htmlspecialchars($row['total_rating']) . '</p>';
            if ($row['photo']) {
                echo '<img src="../../' . htmlspecialchars($row['photo']) . '" alt="Anime Photo" class="search-result-photo">';
            } else {
                echo 'No Photo Available';
            }
            echo '</div>';
        }
    } else {
        echo 'No results found.';
    }

    $stmt->close();
} else {
    // Handle the case where searchTerm is not set in the POST request
    echo 'No search term provided.';
}

$conn->close();
?>
