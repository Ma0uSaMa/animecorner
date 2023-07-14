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
    <!-- Other stylesheets and meta tags -->
</head>
<body>
    <div class="registered-users">
        <h1>Registered Users</h1>
        <table>
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through the users and display them -->
                <?php
                $rowNum = 0;
                foreach ($users as $user):
                    $rowNum++;
                ?>
                    <tr>
                        <td><?php echo $rowNum; ?></td>
                        <td><?php echo $user['firstname']; ?></td>
                        <td><?php echo $user['lastname']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['dob']; ?></td>
                        <td><?php echo $user['gender']; ?></td>
                        <td>No</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
