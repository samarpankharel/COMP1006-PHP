<?php
session_start();
//Redirects the user to login first
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}
require './includes/header.php';
require_once 'product.php';
require_once './config/database.php';
session_start();
//No access if not logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied.");
}
//Connect to the database
$db = new Database();
$conn = $db->connect();
$product = new Product($conn);
//Get the users ID
$id = isset($_GET['id']) ? $_GET['id'] : null;
$user_id = $_SESSION['user_id'];
//Checks the existence of the product
if (!$id || !$data = $product->getByID($id)) {
    die("Product not found");
}
//Checks the Ownership of the product
if ($data['user_id'] != $user_id) {
    die("You are not authorized to update this product.");
}
// Form for updating the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imageName = null;
    // Image update with Valid type of image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['image']['type'];
        if (in_array($fileType, $allowedTypes)) {
            $imageName = uniqid() . "-" . basename($_FILES["image"]["name"]);
            $targetFilePath = "uploads/" . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
        }
    }
  //Update the product finally and redirect to the homepage
    if ($product->update($id, $user_id, $product_name, $description, $price, $imageName)) {
        header("Location: index.php");
        exit;
        //If error occurs display the message
    } else {
        $error = "Error updating product.";
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label>Product Name:</label>
    <input type="text" name="product_name" value="<?= htmlspecialchars($data['product_name']) ?>" required><br>
    <label>Description:</label>
    <textarea name="description" required><?= htmlspecialchars($data['description']) ?></textarea><br>
    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?= $data['price'] ?>" required><br>
    <label>Image:</label>
    <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Update Product">
</form>

<?php require './includes/footer.php'; ?>
