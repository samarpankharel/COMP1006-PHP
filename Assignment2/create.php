<?php
//Loading the required php files by require:
require 'header.php';
require 'user.php';
require 'database.php';
//Connecting to the database
$db = (new Database())->connect();
// Create a new user with the database connection
$user = new User($db);
//Collect data from the submitted form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $imageName = '';
    //Check if the image was uploaded and save it with unique name
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
    }
 //Create a new record in the database and redirect to homepage(index.php)
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
   <!--Redirect the user to homepage-->
    <a href="index.php">Back</a>
<?php require 'footer.php'; ?>