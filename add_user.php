<?php
session_start();
include "config.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $message = "All fields are required!";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $message = "User Added Successfully!";
        } else {
            $message = "Error!";
        }

        $stmt->close();
    }
}
?>

<h2>Add User</h2>
<p style="color:green;"><?php echo $message; ?></p>

<form method="POST">
Name: <input type="text" name="name"><br><br>
Email: <input type="email" name="email"><br><br>
Password: <input type="password" name="password"><br><br>
Role:
<select name="role">
    <option value="">Select</option>
    <option value="admin">Admin</option>
    <option value="user">User</option>
</select><br><br>
<button type="submit" name="submit">Add User</button>
</form>