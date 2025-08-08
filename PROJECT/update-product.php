<?php
session_start();
require './includes/header.php';
require_once 'product.php';
require_once './config/database.php';
//Redirect user to login first
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}
//Connect to the database
$db = new Database();
$conn = $db->connect();
$product = new Product($conn);
//Validates the ID
$id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$id) {
    die("Invalid request.");
}
// Check's the ownership of the product
$data = $product->getByID($id);
if (!$data || $data['user_id'] != $_SESSION['user_id']) {
    die("Unauthorized access.");
}
// Updates the data of the given below:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imageName = $data['image'];
    //Updates the new Image
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = uniqid() . "-" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $imageName);
    }
   //Update the product in the database
    if ($product->update($id, $_SESSION['user_id'], $product_name, $description, $price, $imageName)) {
        header("Location: content.php");
        exit;
    } else {
        $error = "Failed to update product.";
    }
}
?>

<main>
    <h2>Edit Product</h2>

    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        <label>Product Name:</label>
        <input type="text" name="product_name" value="<?= htmlspecialchars($data['product_name']) ?>" required><br>
        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($data['description']) ?></textarea><br>
        <label>Price:</label>
        <input type="number" name="price" step="0.01" value="<?= htmlspecialchars($data['price']) ?>" required><br>
        <label>Current Image:</label><br>
        <?php if ($data['image']): ?>
            <img src="uploads/<?= htmlspecialchars($data['image']) ?>" width="100"><br>
        <?php else: ?>
            No image uploaded<br>
        <?php endif; ?>
        <label>New Image (optional):</label>
        <input type="file" name="image"><br><br>
        <input type="submit" value="Update Product">
    </form>
</main>

<?php require './includes/footer.php'; ?>
