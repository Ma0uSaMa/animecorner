<?php
header("Content-Type: application/json");
session_start();
require_once('../../includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];

  // Fetch user data from the database
  $query = "SELECT id, email, password FROM users_credentials WHERE email = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $stmt->bind_result($id, $fetchedEmail, $hashedPassword);
  $stmt->fetch();
  $stmt->close();

  if ($fetchedEmail === $email && password_verify($_POST['password'], $hashedPassword)) {
    $_SESSION['user_id'] = $id;
    $_SESSION['user_email'] = $fetchedEmail;

    $response = ['status' => 'success'];
} else {
  $error = urlencode('Invalid email or password');
  header("Location: ../../login.php?error=$error");
}

  echo json_encode($response);
}
?>
