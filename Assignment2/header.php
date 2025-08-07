<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="A simple user management System">
    <meta name="keywords" content="user management, user records, CRUD, profile management">
    <meta name="author" content="Samarpan Kharel">
    <link rel="icon" href="image/favicon.png" type="image/x-icon">
    <title>Product System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once 'auth.php';
$currentUser = getCurrentUser();
?>
<header>
    <div class="header-top">
        <a href="index.php">
            <img src="image/logo.jpg" alt="Logo" class="logo">
        </a>
        <div class="header-text">
            <h1>User Management System</h1>
            <p>Manage your users efficiently</p>
        </div>

        <div class="user-info">
            <?php if ($currentUser): ?>
                <span>Welcome, <?= htmlspecialchars($currentUser['name']) ?>!</span>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </div>
    </div>
    <nav>
        <ul class="nav-links">
            <li><a href="index.php">View Users</a></li>
            <?php if (isLoggedIn()): ?>
                <li><a href="create.php">Add User</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>