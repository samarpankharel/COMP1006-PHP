<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="A simple grade tracker application">
    <meta name="keywords" content="grades, tracker, school, education">
    <meta name="author" content="Samarpan Kharel">
    <link rel="icon" href="image/icons8-favicon-94.png" type="image/x-icon">
    <link rel="stylesheet" href="css/styles.css">
    <title>Grade Tracker</title>
</head>
<body>
<header>
    <div class="header-top">
        <a href="page.php">
            <img src="image/logo.jpg" alt="Logo" class="logo">
        </a>
        <div class="header-text">
            <h1>Grade Tracker</h1>
            <p>Track your grades easily</p>
        </div>
    </div>
    <nav>
        <ul class="nav-links">
            <li><a href="#grade-form">Add Grade</a></li>
            <li><a href="viewpage.php">View Grades</a></li>
        </ul>
    </nav>
</header>
<main>
    <section id="grade-form">
        <h2>Student Details</h2>
        <?php
        // Include the add.php file here - this will execute all PHP code in add.php
        include_once("add.php");
        ?>

        <!-- HTML forms to collect the students Information -->
        <form id="add-grade-form" method="POST">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name" required> <br>

            <label for="age">Student Age:</label>
            <input type="number" id="age" name="age" required> <br>

            <label for="student id">Student ID:</label>
            <input type="number" id="student_id" name="student_id" required> <br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required> <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required> <br>

            <label for="grade">Grade:</label>
            <input type="number" id="grade" name="grade" min="0" max="100" required> <br>
            <br>
            <button class="submit-btn" type="submit" name="submit">Add Grade</button>
            <button class="reset-btn" type="reset">Reset</button>
        </form>
    </section>

</main>
<footer>
    <p>&copy; 2023 Samarpan Kharel</p>
</footer>
</body>
</html>
