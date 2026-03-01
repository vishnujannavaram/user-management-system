<?php
include 'config.php';

$id = $_GET['id'];

// Fetch existing data
$result = mysqli_query($conn, "SELECT * FROM students WHERE id=$id");
$row = mysqli_fetch_assoc($result);

// Update data
if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    mysqli_query($conn, "UPDATE students SET 
        name='$name',
        email='$email',
        phone='$phone',
        course='$course',
        gender='$gender',
        dob='$dob'
        WHERE id=$id");

    header("Location: view_students.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>

<h2>Edit Student</h2>

<form method="POST">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br><br>
    Course: <input type="text" name="course" value="<?php echo $row['course']; ?>"><br><br>
    Gender: <input type="text" name="gender" value="<?php echo $row['gender']; ?>"><br><br>
    DOB: <input type="date" name="dob" value="<?php echo $row['dob']; ?>"><br><br>

    <input type="submit" name="update" value="Update Student">
</form>

</body>
</html>