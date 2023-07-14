<?php
session_start();
require_once('../../includes/db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $gender = $_POST['gender'];

    // Perform validation and error checking
    $errors = [];

    // Validate the email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Check if the password and confirm password match
    if ($password !== $confirmpassword) {
        $errors[] = "Passwords do not match";
    }

    // Validate and format the date of birth (dob)
    $month = date_parse($month)['month']; // Convert month to integer
    if (!checkdate($month, $day, $year)) {
        $errors[] = "Invalid date of birth";
    } else {
        $dob = date("Y-m-d", strtotime("$year-$month-$day"));
    }

    // Check if there are any validation errors
    if (count($errors) > 0) {
        $_SESSION['registration_errors'] = $errors;
        header("Location: ../../register.php");
        exit();
    } else {
        // Check if the email already exists in the database
        $query = "SELECT COUNT(*) FROM users_credentials WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        if ($count > 0) {
            $error = "Email already exists.";
            $_SESSION['registration_errors'] = [$error];
            echo json_encode(['status' => 'error', 'message' => $error]);
            exit();
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Insert the user data into the database
            $query = "INSERT INTO users_credentials (firstname, lastname, email, password, dob, gender) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssss", $firstname, $lastname, $email, $hashedPassword, $dob, $gender);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Registration successful']);
                exit();
            } else {
                $error = "Account creation failed.";
                $_SESSION['registration_errors'] = [$error];
                echo json_encode(['status' => 'error', 'message' => $error]);
                exit();
            }

            $stmt->close();
        }
    }
}
?>
