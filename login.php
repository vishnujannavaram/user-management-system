<?php
include "config.php";
session_start();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
         
        if(password_verify($password, $row['password'])){
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role_id'] = $row['role_id'];

              if($row['role_id'] == 1){
    header("Location: admin_dashboard.php");
} else {
    header("Location: user_dashboard.php");
}
exit();
        } else {
            echo "Wrong Password!";
        }

    } else {
        echo "User Not Found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>User Login</h2>

<form method="POST">
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>