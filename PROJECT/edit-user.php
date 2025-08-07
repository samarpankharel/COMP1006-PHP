<?php
session_start();
require 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    die("Access denied.");
}

$database = new Database();
$conn = $database->connect();

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update statement
    $stmt = $conn->prepare("UPDATE users SET fullname=?, username=?, email=? WHERE id=?");
    $stmt->execute([$fullname, $username, $email, $id]);

    header("Location: users.php");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <h2>Edit User</h2>
    <form method="POST">
        <label>Full Name:</label>
        <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>

        <label>Username:</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <button type="submit">Update</button>
    </form>
</main>

<?php include 'includes/footer.php'; ?>
