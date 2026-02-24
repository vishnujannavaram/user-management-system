<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1){
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Admin Dashboard</h2>
<h3>All Registered Users</h3>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
</tr>
<?php } ?>

</table>

<br>
<a href="logout.php">Logout</a>

</body>
</html>