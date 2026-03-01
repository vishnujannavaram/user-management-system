<?php
session_start();
include 'config.php';

/* ================= REGISTER ================= */

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($conn,"INSERT INTO users (name,email,password) 
                        VALUES ('$name','$email','$password')");
}

/* ================= LOGIN ================= */

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,"SELECT * FROM users 
                                  WHERE email='$email' 
                                  AND password='$password'");

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row['name'];
    } else {
        echo "Invalid Login!";
    }
}

/* ================= DELETE ================= */

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM users WHERE id=$id");
    header("Location: index.php");
}

/* ================= LOGOUT ================= */

if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>
</head>
<body>

<?php if(!isset($_SESSION['user'])){ ?>

<!-- ================= REGISTRATION ================= -->

<h2>Registration</h2>
<form method="POST">
    Name:<br>
    <input type="text" name="name" required><br>
    Email:<br>
    <input type="email" name="email" required><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit" name="register">Register</button>
</form>

<hr>

<!-- ================= LOGIN ================= -->

<h2>Login</h2>
<form method="POST">
    Email:<br>
    <input type="email" name="email" required><br>
    Password:<br>
    <input type="password" name="password" required><br><br>
    <button type="submit" name="login">Login</button>
</form>

<?php } else { ?>

<!-- ================= DASHBOARD ================= -->

<h3>Welcome, <?php echo $_SESSION['user']; ?> | 
<a href="index.php?logout=true">Logout</a>
</h3>

<h2>User List (CRUD)</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM users");
while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
        <a href="edit_user.php?id=<?php echo $row['id']; ?>">Edit</a> |
        <a href="index.php?delete=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure?')">
           Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>

<?php } ?>

</body>
</html>