<?php
require 'auth.php';
require 'header.php';
require 'database.php';
require 'user.php';

// Require login to edit users
requireLogin();

$db = (new Database())->connect();
$userObj = new User($db);

$id = $_GET['id'];
$existingUser = $userObj->getById($id);
$oldImage = $existingUser['image'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $imageName = $oldImage;

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        if ($oldImage && file_exists("uploads/" . $oldImage)) {
            unlink("uploads/" . $oldImage);
        }
    }

    $userObj->update($id, $name, $email, $imageName);
    header("Location: index.php");
    exit;
}
?>
    <main>
        <h2>Edit User</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="name" value="<?= htmlspecialchars($existingUser['name']) ?>" required><br>
            <input type="email" name="email" value="<?= htmlspecialchars($existingUser['email']) ?>" required><br>
            <?php if ($oldImage): ?>
                <img src="uploads/<?= $oldImage ?>" width="100"><br>
            <?php endif; ?>
            <input type="file" name="image"><br>
            <button type="submit">Update</button>
        </form>
        <a href="index.php">Back</a>
    </main>
<?php require 'footer.php'; ?>