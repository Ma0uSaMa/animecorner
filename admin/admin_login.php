<?php
session_start();

if (isset($_POST['submit'])) {
    // Database connection
    require_once '../includes/db_connection.php';

    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to retrieve the admin credentials from the database
    $sql = "SELECT * FROM admin_credentials WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the entered password against the hashed password
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['admin_username'] = $row['name'];
            header("Location: dashboard/dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Animecorner - Admin Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../css/admin_login.css">
    <link rel="icon" type="image/png" href="../images/logo-image.png">
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method='POST' action="">
                    <h2>Admin Login</h2>
                    <?php if (isset($error)) { ?>
                        <div class="error"><?php echo $error; ?></div>
                     <?php } ?>
                    <div class="inputbox">
                    <i class='bx bxs-user'></i>
                        <input type="username" name="username" required>
                        <label for="">Username</label>
                    </div>
                    <div class="inputbox">
                    <i class='bx bx-lock-alt' ></i>
                        <input type="password" name="password"  required>
                        <label for="">Password</label>
                    </div>
                    <button type="submit" name="submit">Login</button>
                </form>
            </div>
            
        </div>
    </section>
</body>
</html>
