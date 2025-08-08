<?php
require 'auth.php';
require 'database.php';
require 'user.php';

// Require login to delete
requireLogin();

if (isset($_GET['id'])) {
    $db = (new Database())->connect();
    $userObj = new User($db);

    // Get user data to delete image file
    $userData = $userObj->getById($_GET['id']);

    if ($userData) {
        // Delete image file if exists
        if ($userData['image'] && file_exists("uploads/" . $userData['image'])) {
            unlink("uploads/" . $userData['image']);
        }

        // Delete user record
        if ($userObj->delete($_GET['id'])) {
            header("Location: index.php?message=User deleted successfully");
        } else {
            header("Location: index.php?error=Failed to delete user");
        }
    } else {
        header("Location: index.php?error=User not found");
    }
} else {
    header("Location: index.php");
}
exit;
?>