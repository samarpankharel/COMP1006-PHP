<?php
require 'header.php';
require 'database.php';
require 'user.php';

$db = (new Database())->connect();
$user = new User($db);
$users = $user->getAll();

// Display messages
$message = $_GET['message'] ?? '';
$error = $_GET['error'] ?? '';
?>
    <main>
        <h2>All Users</h2>

        <?php if ($message): ?>
            <div class="success-message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if (isLoggedIn()): ?>
            <a href="create.php">Create New User</a>
        <?php endif; ?>

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Image</th>
                <?php if (isLoggedIn()): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['name']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td>
                        <?php if ($u['image']): ?>
                            <img src="uploads/<?= $u['image'] ?>" width="50">
                        <?php endif; ?>
                    </td>
                    <?php if (isLoggedIn()): ?>
                        <td>
                            <a href="edit.php?id=<?= $u['id'] ?>">Edit</a>
                            <a href="delete.php?id=<?= $u['id'] ?>"
                               onclick="return confirm('Are you sure you want to delete this user?')"
                               class="delete-btn">Delete</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
<?php require 'footer.php'; ?>