<?php
session_start();
include "db_connect.php";

if (!isset($_GET['id'])) {
    die("User ID not found");
}

$id = $_GET['id'];

// Fetch existing user
$sql = "SELECT * FROM users WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Update user
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $update_sql = "UPDATE users SET name='$name', email='$email' WHERE id=$id";
    
    if ($conn->query($update_sql) === TRUE) {
        header("Location: view_user.php");
        exit();
    } else {
        echo "Error updating record";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    Email: <input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
    <input type="submit" name="update" value="Update">
</form>

</body>
</html>