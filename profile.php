<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "user_management");

// 1. Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// 2. Get logged-in user details
$name = $_SESSION['user'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE name='$name'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Page</title>
</head>
<body>

<h2>Welcome to Your Profile</h2>

<p><strong>Name:</strong> <?php echo $user['name']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>

<a href="logout.php">Logout</a>

</body>
</html>