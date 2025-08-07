<?php
require 'header.php';
require 'user.php';
require 'database.php';

$db = (new Database())->connect();
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $imageName = '';

    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
    }

    $user->create($name, $email, $imageName);
    header("Location: index.php");
    exit;
}
?>
    <h2>Create User</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="text" name="name" required placeholder="Name"><br>
        <input type="email" name="email" required placeholder="Email"><br>
        <input type="file" name="image"><br>
        <button type="submit">Submit</button>
    </form>
    <a href="index.php">Back</a>
<?php require 'footer.php'; ?>