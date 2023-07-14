<?php
// Database connection
require_once '../../includes/db_connection.php';

// Admin credential data
$name = 'Sayonara';
$username = 'admin';
$password = password_hash('admin123', PASSWORD_DEFAULT);
$role = 'super admin';
$status = 'active';

// Prepare the SQL statement
$stmt = $conn->prepare("INSERT INTO admin_credentials (name, username, password, role, status) VALUES (?, ?, ?, ?, ?)");

// Bind the parameters
$stmt->bind_param("sssss", $name, $username, $password, $role, $status);

// Execute the statement
if ($stmt->execute()) {
    echo "Admin credential inserted successfully.";
} else {
    echo "Error inserting admin credential: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
