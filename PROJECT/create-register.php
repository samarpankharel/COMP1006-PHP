<?php
require 'config/database.php';
//Collect the user's input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($fullname) || empty($email) || empty($username) || empty($password)) {
        die('All fields are required.');
    }

    // Create DB instance
    $database = new Database();
    // Get connection
    $conn = $database->connect();
    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        die('Email already exists. Please use another email.');
    }

    // Hash Password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$fullname, $username, $email, $hashedPassword])) {
        echo "Registration successful. <a href='auth.php'>Login Here</a>";
    } else {
        echo "Registration failed.";
    }
}
?>
