<?php
// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection file
require_once('includes/db_connection.php');

// Check if the connection was successful
if (!$conn || $conn->connect_errno) {
    die("Database connection not established or already closed.");
}

// Verify user is logged in and get their user ID
if (!isset($_SESSION['user_id'])) {
    die("Please log in to view recommendations.");
}
$user_id = $_SESSION['user_id'];

// Fetch anime descriptions for all anime to calculate TF-IDF
function fetchAllAnimeDescriptions($conn) {
    $query = "SELECT id, description FROM anime_details_insert";
    $result = $conn->query($query);
    $documents = [];
    $animeIds = [];

    while ($row = $result->fetch_assoc()) {
        $documents[] = $row['description'];
        $animeIds[] = $row['id'];
    }

    return [$documents, $animeIds];
}

// Calculate Term Frequency (TF)
function calculateTF($text) {
    $words = explode(" ", strtolower($text));
    $totalWords = count($words);
    $tf = [];
    
    foreach ($words as $word) {
        $word = preg_replace('/[^a-zA-Z0-9]/', '', $word);
        if ($word != "") {
            $tf[$word] = isset($tf[$word]) ? $tf[$word] + 1 : 1;
        }
    }
    
    foreach ($tf as $word => $count) {
        $tf[$word] = $count / $totalWords;
    }
    
    return $tf;
}

// Calculate Inverse Document Frequency (IDF)
function calculateIDF($documents) {
    $idf = [];
    $totalDocuments = count($documents);
    
    foreach ($documents as $document) {
        $uniqueWords = array_keys(calculateTF($document));
        foreach ($uniqueWords as $word) {
            $idf[$word] = isset($idf[$word]) ? $idf[$word] + 1 : 1;
        }
    }
    
    foreach ($idf as $word => $count) {
        $idf[$word] = log($totalDocuments / (1 + $count));
    }
    
    return $idf;
}

// Calculate TF-IDF Vector
function calculateTFIDF($tf, $idf) {
    $tfidf = [];
    foreach ($tf as $word => $tfScore) {
        $tfidf[$word] = $tfScore * (isset($idf[$word]) ? $idf[$word] : 0);
    }
    return $tfidf;
}

// Cosine Similarity
function cosineSimilarity($vectorA, $vectorB) {
    $dotProduct = 0;
    $magnitudeA = 0;
    $magnitudeB = 0;
    
    foreach ($vectorA as $key => $value) {
        $dotProduct += $value * (isset($vectorB[$key]) ? $vectorB[$key] : 0);
        $magnitudeA += pow($value, 2);
    }
    
    foreach ($vectorB as $value) {
        $magnitudeB += pow($value, 2);
    }
    
    return $dotProduct / (sqrt($magnitudeA) * sqrt($magnitudeB));
}

// Fetch Anime Rated by User
function fetchUserRatedAnime($user_id, $conn) {
    $query = "SELECT anime_id FROM anime_ratings WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $ratedAnime = [];
    while ($row = $result->fetch_assoc()) {
        $ratedAnime[] = $row['anime_id'];
    }
    
    return $ratedAnime;
}

// Generate Personalized Recommendations Based on Rated Anime
function getPersonalizedRecommendations($ratedAnime, $animeTFIDF) {
    $similarities = [];

    foreach ($ratedAnime as $animeId) {
        $targetVector = $animeTFIDF[$animeId];
        
        foreach ($animeTFIDF as $id => $vector) {
            if (!in_array($id, $ratedAnime)) {  
                $similarities[$id] = isset($similarities[$id]) ? $similarities[$id] + $similarity : $similarity;
            }
        }
    }

    arsort($similarities);
    return array_slice($similarities, 0, 5, true);  
}

// Main Execution Flow
list($documents, $animeIds) = fetchAllAnimeDescriptions($conn);
$idf = calculateIDF($documents);

// Calculate and store TF-IDF vectors
$animeTFIDF = [];
foreach ($documents as $index => $description) {
    $tf = calculateTF($description);
    $tfidf = calculateTFIDF($tf, $idf);
    $animeTFIDF[$animeIds[$index]] = $tfidf;
}

// Fetch the anime that the user has rated
$ratedAnime = fetchUserRatedAnime($user_id, $conn);

if (empty($ratedAnime)) {
    echo "Please rate some anime to receive recommendations.";
    exit;
}

// Generate recommendations based on user-rated anime
$recommendedAnime = getPersonalizedRecommendations($ratedAnime, $animeTFIDF);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommended Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center">Recommended Anime for You</h1>
        <div class="row">
            <?php if (empty($recommendedAnime)) : ?>
                <div class="alert alert-warning text-center">No recommendations found. Please rate more anime to get personalized recommendations.</div>
            <?php else : ?>
                <?php
                foreach ($recommendedAnime as $id => $similarityScore) {
                    $query = "SELECT title, photo FROM anime_details_insert WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($row = $result->fetch_assoc()) {
                        echo '<div class="col-md-4">';
                        echo '<div class="card">';
                        echo '<img src="' . htmlspecialchars($row['photo']) . '" class="card-img-top" alt="' . htmlspecialchars($row['title']) . '">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                        echo '<p class="card-text">Similarity Score: ' . number_format($similarityScore, 2) . '</p>';
                        echo '</div></div></div>';
                    }
                }
                ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
