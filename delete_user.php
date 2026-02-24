<?php
session_start();
include("config.php");

if($_SESSION['role_id'] != 1){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("Location: admin_dashboard.php");
exit();
?>