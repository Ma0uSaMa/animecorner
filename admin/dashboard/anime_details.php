<?php
if (!isset($_SESSION['admin_username'])) {
    header("Location: ../admin_login.php");
    exit();
}

require_once('../../includes/db_connection.php');

// Fetch anime details from the database
$query = "SELECT * FROM anime_details_insert";
$result = $conn->query($query);

// Initialize an empty array to store anime details
$anime_details = array();

if ($result->num_rows > 0) {
    // Iterate over each row and store the details in the array
    while ($row = $result->fetch_assoc()) {
        $anime_details[] = $row;
    }
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
    <div class="container">
        <section class="content-section">
            <h1 class="section-title">Anime Details</h1>

            <table class="anime-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Aired Date</th>
                        <th>Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if anime details are available
                    if (isset($anime_details) && is_array($anime_details) && count($anime_details) > 0) {
                        // Iterate over each anime and display the details in the table rows
                        foreach ($anime_details as $anime) {
                            ?>
                            <tr>
                                <td><?php echo $anime['title']; ?></td>
                                <td><?php echo $anime['description']; ?></td>
                                <td><?php echo $anime['aired_date']; ?></td>
                                <td>
                                    <img src="../../<?php echo $anime['photo']; ?>" class="anime-photo" alt="Anime Photo">
                                </td>

                                <td>
                                    <a href="update_anime.php?id=<?php echo $anime['id']; ?>" class="action-link">Update</a>
                                    <a href="delete_anime.php?id=<?php echo $anime['id']; ?>" class="action-link">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        // Display a message when no anime details are found
                        ?>
                        <tr>
                            <td colspan="4">No anime details found.</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../js/dashboard_sidebar.js"></script>
</body>
</html>

<?php
$conn->close();
?>
