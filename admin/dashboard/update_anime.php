<?php
session_start();
require_once('../../includes/db_connection.php');

// Check if the 'id' parameter is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: anime_details.php");
    exit();
}

$id = $_GET['id'];

// Fetch anime details from the database based on the provided 'id'
$query = "SELECT * FROM anime_details_insert WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: anime_details.php");
    exit();
}

$anime = $result->fetch_assoc();

// Handle form submission for updating anime details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);
    $aired_date = htmlspecialchars($_POST['aired_date']);

    // You can add more fields as needed

    // Perform validation if necessary

    // Update anime details in the database
    $updateQuery = "UPDATE anime_details_insert SET title = ?, description = ?, aired_date = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssi", $title, $description, $aired_date, $id);

    if ($updateStmt->execute()) {
        // Redirect to the anime details page after successful update
        header("Location: dashboard.php?page=anime_details");
        exit();
    } else {
        // Handle the update error if needed
        $updateError = "Failed to update anime details.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Anime</title>
    <link rel="stylesheet" type="text/css" href="../../css/update_anime.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../css/dashboard_navbar.css">
    <link rel="stylesheet" type="text/css" href="../../css/dashboard_sidebar.css">
    <link rel="icon" type="image/png" href="../../images/logo-image.png">
</head>
<body>
    <?php include __DIR__ . '/../../partials/dashboard_sidebar.php'; ?>
    <?php include __DIR__ . '/../../partials/dashboard_navbar.php'; ?>
    <div class="container">
        <h1>Update Anime Details</h1>
        <?php if (isset($updateError)) { ?>
            <div class="error"><?php echo $updateError; ?></div>
        <?php } ?>

        <form method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $anime['title']; ?>" required>
            
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $anime['description']; ?></textarea>
            
            <label for="aired_date">Aired Date:</label>
            <input type="date" id="aired_date" name="aired_date" value="<?php echo $anime['aired_date']; ?>" required>
            
            <!-- Add more form fields as needed -->

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>
