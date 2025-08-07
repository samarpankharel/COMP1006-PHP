<?php
session_start();
require 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    die("Access denied.");
}

$database = new Database();
$conn = $database->connect();

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: users.php");
exit;
