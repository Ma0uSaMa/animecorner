<?php
require_once('../../includes/db_connection.php');

$query = "SELECT firstname, lastname, email, dob, gender FROM users_credentials";
$result = $conn->query($query);
$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <link rel="stylesheet" type="text/css" href="../../css/registered_users.css">
</head>
<body>
    <div class="registered-users">
        <h1>Registered Users</h1>
        <table>
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['firstname']; ?></td>
                        <td><?php echo $user['lastname']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['dob']; ?></td>
                        <td><?php echo $user['gender']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
