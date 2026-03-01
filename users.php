<?php
session_start();
include 'config.php';

/* 🔐 Protect Page (Phase 9) */
if(!isset($_SESSION['user'])){
    header("Location: index.php");
    exit();
}

/* 🗑 Delete User */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM users WHERE id=$id");
    header("Location: user.php");
    exit();
}

/* 🚪 Logout */
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <style>
        body { font-family: Arial; }
        table { border-collapse: collapse; width: 70%; }
        th, td { padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h3>
    Welcome, <?php echo $_SESSION['user']; ?> |
    <a href="user.php?logout=true">Logout</a>
</h3>

<h2>User List (CRUD)</h2>

<table border="1">
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
        <a href="user.php?delete=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure?')">
           Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>