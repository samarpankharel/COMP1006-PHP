<?php
include 'include/database.php';

// Creating an instance of the database class
$db = new database();
$conn = $db->conn;

// Fetch data from Students table
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grades</title>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <a href="page.php">
        <img src="image/logo.jpg" alt="Logo" class="logo">
</header>
<div class="container">
    <!-- Back Button -->
    <a href="page.php" class="btn-back"> Back to Dashboard</a>

    <!-- View Grades Card -->
    <div class="card">
        <div class="card-header">
            <h3 class="Grades"> Your Grades</h3>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Student Age</th>
                <th>Student ID</th>
                <th>Grade</th>
                <th>Address</th>
                <th>Date Added</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($result->num_rows > 0) {
                //To display the data in a table going through each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['age']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "</tr>";
                }
            }
            // If no table is found or the Information is not added yet
            else {
                echo "<tr><td colspan='6'>No records found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
