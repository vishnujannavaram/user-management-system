<?php
include 'config.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    $query = "INSERT INTO students (name,email,phone,course,gender,dob) 
              VALUES ('$name','$email','$phone','$course','$gender','$dob')";

    mysqli_query($conn,$query);

    echo "Student Added Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
</head>
<body>

<h2>Add Student</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Phone: <input type="text" name="phone"><br><br>
    Course: <input type="text" name="course" required><br><br>
    Gender: 
    <select name="gender">
        <option>Male</option>
        <option>Female</option>
    </select><br><br>
    DOB: <input type="date" name="dob"><br><br>

    <button type="submit" name="submit">Add Student</button>
</form>

</body>
</html>