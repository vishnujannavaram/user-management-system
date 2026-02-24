<?php
include "config.php";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role_id) 
            VALUES ('$name', '$email', '$password', '$role')";

    if(mysqli_query($conn, $sql)){
        echo "Registration Successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>User Registration</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    Role:
    <select name="role">
        <option value="1">Admin</option>
        <option value="2">User</option>
    </select>
    <br><br>

    <button type="submit" name="submit">Register</button>
</form>

</body>
</html>