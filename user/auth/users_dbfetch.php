<?php
session_start();
require_once('../../includes/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic input validation
    if (empty($email) || empty($password)) {
        $_SESSION['login_errors'] = ['Please enter both email and password.'];
        echo json_encode(['status' => 'error', 'message' => 'Please enter both email and password.']);
        exit();
    }

    // Fetch user data from the database
    $query = "SELECT id, email, password FROM users_credentials WHERE email = ?";
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid']);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    if ($stmt->error) {
        echo json_encode(['status' => 'error', 'message' => 'An error occurred during form submission.']);
        exit();
    }

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header("Location: ../../home.php");
        
        exit();
    } else {
        // Return an error message as JSON
        $error = 'Invalid email or password.';
        header("Location: ../../login.php");
        echo json_encode(['status' => 'error', 'message' => $error]);
        exit();
    }
}
?>
