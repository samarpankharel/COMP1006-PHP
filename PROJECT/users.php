<?php
session_start();
require 'config/database.php';

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please <a href='auth.php'>login</a> first.");
}

$database = new Database();
$conn = $database->connect();

// Fetch all users
$stmt = $conn->prepare("SELECT id, fullname, username, email, profile_image FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<main>
    <h2>All Registered Users</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Profile Image</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <?php if (!empty($user['profile_image'])): ?>
                        <img src="<?= htmlspecialchars($user['profile_image']) ?>" width="60" height="60">
                    <?php else: ?>
                        No Image
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($user['fullname']) ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td>
                    <a href="edit-user.php?id=<?= $user['id'] ?>">Edit</a> |
                    <a href="delete-user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>

<?php include 'includes/footer.php'; ?>
