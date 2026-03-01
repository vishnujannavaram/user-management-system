<?php
include 'config.php';

$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
</head>
<body>

<h2>Student List</h2>

<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Course</th>
    <th>Gender</th>
    <th>DOB</th>
    <th>Actions</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td><?php echo $row['course']; ?></td>
    <td><?php echo $row['gender']; ?></td>
    <td><?php echo $row['dob']; ?></td>

    <td>
        <!-- Edit Link -->
        <a href="edit_student.php?id=<?php echo $row['id']; ?>">
            Edit
        </a>

        |

        <!-- Delete Link -->
        <a href="delete_student.php?id=<?php echo $row['id']; ?>" 
           onclick="return confirm('Are you sure you want to delete?');">
            Delete
        </a>
    </td>

</tr>

<?php } ?>

</table>

</body>
</html>