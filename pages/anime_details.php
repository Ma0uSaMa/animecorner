<?php
require_once('includes/db_connection.php');

// Fetch anime details from the database
$query = "SELECT * FROM anime_details_insert";
$result = $conn->query($query);

if ($result === false) {
    die("Error retrieving anime details: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .anime-details-title {
            text-align: center;
            margin: 20px 0;
            font-size: 2.5rem;
            color: #343a40;
        }
        .anime-details-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px;
        }
        .anime-card {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .anime-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .anime-photo {
            width: 100%;
            height: 200px; /* Fixed height for all images */
            object-fit: cover;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .anime-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin: 10px;
            color: #212529;
            text-align: center;
        }
        .anime-description {
            font-size: 0.9rem;
            color: #6c757d;
            margin: 10px;
            max-height: 100px; /* Fixed height for text content */
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .anime-aired-date {
            font-size: 0.9rem;
            font-weight: bold;
            margin: 10px;
            color: #495057;
        }
        .anime-card .card-body {
            min-height: 150px; /* Fixed height for card body */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }
        form input[type="number"] {
            width: 80%;
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        form input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        form input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 class="anime-details-title">Anime Details</h1>
    <div class="anime-details-container">
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="anime-card">
                <?php if ($row['photo']) : ?>
                    <img class="anime-photo" src="<?php echo $row['photo']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                <?php else : ?>
                    <img class="anime-photo" src="https://via.placeholder.com/300x200" alt="No Image Available">
                <?php endif; ?>
                <div class="card-body">
                    <h2 class="anime-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                    <div class="anime-description">Synopsis: <?php echo htmlspecialchars($row['description']); ?></div>
                    <p class="anime-aired-date">Aired Date: <?php echo htmlspecialchars($row['aired_date']); ?></p>
                    <form action="user/submit_rating.php" method="post">
                        <input type="hidden" name="anime_id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="anime_title" value="<?php echo htmlspecialchars($row['title']); ?>">
                        <label for="rating-<?php echo $row['id']; ?>">Rate this anime:</label>
                        <input id="rating-<?php echo $row['id']; ?>" type="number" name="rating" min="1" max="5" placeholder="1-5" required>
                        <input type="submit" value="Submit Rating">
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
