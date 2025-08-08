<?php
//Loading the required php files by require:
require 'auth.php';
require 'header.php';
require 'database.php';
require 'user.php';

// Require login to edit users
requireLogin();
//Connecting to the database
$db = (new Database())->connect();
//creating an user obj with the connection
$userObj = new User($db);

$id = $_GET['id'];
$existingUser = $userObj->getById($id);
$oldImage = $existingUser['image'];
//Check the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Collect the changed data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $imageName = $oldImage;
    //If image is updated then deletes the old and save the updated one
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        //Remove the old Image if there's an old image
        if ($oldImage && file_exists("uploads/" . $oldImage)) {
            unlink("uploads/" . $oldImage);
        }
    }
   //Update the records in the database and redirect it to homepage
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