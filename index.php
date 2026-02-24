<?php
session_start();

/* ======================
   1. DATABASE CONNECTION
====================== */
$conn = mysqli_connect("localhost", "root", "", "user_management");
if (!$conn) {
    die("DB Connection Failed");
}

/* ======================
   2. USER REGISTRATION
====================== */
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
}

/* ======================
   3. LOGIN SYSTEM
====================== */
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user'] = $user['name'];
    }
}

/* ======================
   4. DELETE USER (CRUD)
====================== */
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

/* ======================
   5. FETCH USERS (READ)
====================== */
$users = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>User Management</title>
</head>
<body>

<h2>Registration</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button name="register">Register</button>
</form>

<hr>

<h2>Login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button name="login">Login</button>
</form>

<?php if (isset($_SESSION['user'])) { ?>
    <h3>Welcome, <?php echo $_SESSION['user']; ?></h3>

    <h2>User List (CRUD)</h2>
    <table border="1">
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
        <?php while ($row = mysqli_fetch_assoc($users)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td>
                <a href="?delete=<?= $row['id'] ?>"
                   onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>
<?php } ?>

</body>
</html>