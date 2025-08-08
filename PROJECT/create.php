<?php
require './includes/header.php';
require_once 'product.php';
require_once './config/database.php';
session_start();

// Ensure User is Logged In
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login first.");
}
//Connect to the database
$db = new Database();
$conn = $db->connect();
//create an object called product
$product = new Product($conn);
// Collect the product details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $user_id = $_SESSION['user_id'];
    $imageName = null;
    //Check whether the image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['image']['type'];
        //Ensure the allowed file type is saved
        if (in_array($fileType, $allowedTypes)) {
            $imageName = uniqid() . "-" . basename($_FILES["image"]["name"]);
            $targetFilePath = "uploads/" . $imageName;
            //Store the file in targeted path
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
        }
    }
    //Save data in the database and redirect it to the homepage
    if ($product->create($user_id, $product_name, $description, $price, $imageName)) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Error adding product.";
    }
}
?>
<!--form for submitting the data and uploading the files -->
<form method="post" enctype="multipart/form-data">
    <label>Product Name:</label>
    <input type="text" name="product_name" required><br>
    <label>Description:</label>
    <textarea name="description" required></textarea><br>
    <label>Price:</label>
    <input type="number" step="0.01" name="price" required><br>
    <label>Image:</label>
    <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Add Product">
</form>

<?php require './includes/footer.php'; ?>
