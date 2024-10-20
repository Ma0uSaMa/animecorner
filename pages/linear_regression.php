<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "anime_corner");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start of the container
echo '<div class="anime-details-container">';  // Match this to the container class used in anime_details.php

// Fetch all anime from anime_details_insert table
$anime_query = "SELECT id, title, description, photo FROM anime_details_insert";
$anime_result = $conn->query($anime_query);

if ($anime_result->num_rows > 0) {
    // Loop through each anime
    while ($anime = $anime_result->fetch_assoc()) {
        $anime_id = $anime['id'];
        $anime_title = $anime['title'];
        $anime_description = $anime['description']; // Fetch synopsis/description
        $anime_image = $anime['photo'];  // Fetch image path

        // Query the view counts for this anime
        $sql = "SELECT view_count, view_date FROM anime_views WHERE anime_id = $anime_id ORDER BY view_date ASC";
        $result = $conn->query($sql);

        $view_counts = array();
        $dates = array();
        $index = 1; // We'll use this index to represent days for linear regression

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $view_counts[] = $row['view_count'];
                $dates[] = $index++; // Use index as time (day 1, day 2, etc.)
            }
        } else {
            // If no data found for this anime, skip to the next
            echo "<h3>No data found for $anime_title</h3>";
            continue;
        }

        // Check if the linear_regression function exists before declaring it
        if (!function_exists('linear_regression')) {
            // Function to calculate slope (m) and intercept (c) for linear regression
            function linear_regression($x, $y) {
                $n = count($x);
                if ($n !== count($y)) {
                    throw new Exception("Input arrays must have the same length");
                }

                $sum_x = array_sum($x);
                $sum_y = array_sum($y);
                $sum_x_squared = array_sum(array_map(fn($val) => $val * $val, $x));
                $sum_xy = 0;

                for ($i = 0; $i < $n; $i++) {
                    $sum_xy += $x[$i] * $y[$i];
                }

                // Calculate slope (m) and intercept (c)
                $m = ($n * $sum_xy - $sum_x * $sum_y) / ($n * $sum_x_squared - $sum_x * $sum_x);
                $c = ($sum_y - $m * $sum_x) / $n;

                return [$m, $c];
            }
        }

        // Prepare the time series (as an index representing day 1, day 2, etc.)
        $time_series = range(1, count($view_counts));

        // Perform Linear Regression to calculate slope (m) and intercept (c)
        list($m, $c) = linear_regression($time_series, $view_counts);

        // Predict the view count for the next day (time + 1)
        $next_day = end($time_series) + 1;
        $predicted_next_day_view_count = $m * $next_day + $c;

        // Output the anime image, synopsis, and predicted view count in your desired layout
        echo '<div class="anime-card">';  // Changed to match the anime-card class from anime_details.php
        echo '    <img class="anime-photo" src="' . $anime_image . '" alt="' . $anime_title . '">';  // Same class for the image
        echo '    <h2 class="anime-title">' . $anime_title . '</h2>';  // Use anime-title class for the title
        echo '    <div class="anime-description">Synopsis: ' . $anime_description . '</div>';  // Use anime-description class
        echo '    <p><strong>Predicted View Count:</strong> ' . round($predicted_next_day_view_count) . '</p>';  // Predicted View Count
        echo '</div>';
    }
} else {
    echo "No anime found in the database.";
}

// End of the container
echo '</div>';

$conn->close();
?>
