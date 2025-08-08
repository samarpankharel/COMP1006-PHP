<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}
require './includes/header.php';
require_once 'product.php';
require_once 'config/database.php';
session_start();
//Restricting access
if (!isset($_SESSION['user_id'])) {
    die("Access denied.");
}
//Connect to the database
$db = new Database();
$conn = $db->connect();
$product = new Product($conn);
//Get the product and user id
$id = isset($_GET['id']) ? $_GET['id'] : null;
$user_id = $_SESSION['user_id'];
//Check's the product exists or not
if (!$id || !$data = $product->getByID($id)) {
    die("Product not found");
}
//checks the user has uploaded it or not
if ($data['user_id'] != $user_id) {
    die("You are not authorized to delete this product.");
}
//Delete request is handled
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($product->delete($id, $user_id)) {
        header("Location: home.php");
        exit;
    } else {
        $error = "Error deleting product.";
    }
}
?>

<form method="post">
    <p>Are you sure you want to delete "<strong><?= htmlspecialchars($data['product_name']) ?></strong>"?</p>
    <input type="submit" value="Delete">
    <a href="index.php">Cancel</a>
</form>

<?php require './includes/footer.php'; ?>
