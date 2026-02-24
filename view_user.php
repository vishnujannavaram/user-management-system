<?php
session_start();
include "db_connect.php";

// Check login
if (!isset($_SESSION['role_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
</head>
<body>

<h2>View Users</h2>

<a href="add_user.php">Add New User</a>
<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['role_id'] . "</td>";
        echo "<td>
                <a href='edit_user.php?id=" . $row['id'] . "'>Edit</a> | 
                <a href='delete_user.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure?')\">Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No users found</td></tr>";
}
?>

</table>

<br>
<a href="user_dashboard.php">Back to Dashboard</a>

</body>
</html>