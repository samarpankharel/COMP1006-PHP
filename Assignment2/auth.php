<?php
//Starting the session for storing and accessing the data
session_start();
//Function to check if the user is currently logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
// Function that redirects the user to login
function requireLogin() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        exit;
    }
}
// Function that gets the data of logged in user
function getCurrentUser() {
    if (isLoggedIn()) {
        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email']
        ];
    }
    return null;
}
//Function for logging out and ending the session also
// redirect them back to login page
function logout() {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>