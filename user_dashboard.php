<?php
session_start();

// Allow only normal user (role_id = 2)
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>

<h2>User Dashboard</h2>

<p>Welcome Normal User 👤</p>

<hr>

<a href="view_user.php">View Users</a><br><br>

<a href="add_user.php">Add User</a><br><br>

<a href="logout.php">Logout</a>

</body>
</html>