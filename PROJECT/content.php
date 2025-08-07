<link rel="stylesheet" href="assets/styles.css">
<?php
session_start();
require './includes/header.php';
require_once 'product.php';
require_once './config/database.php';

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please <a href='auth.php'>login</a>.");
}

$db = new Database();
$conn = $db->connect();
$product = new Product($conn);

// Fetch all products for the logged-in user
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM products WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$products = $stmt->fetchAll();
?>

<main>
    <h2>Your Products</h2>
    <a href="create.php">+ Add New Product</a>
    <br><br>

    <?php if (count($products) === 0): ?>
        <p>No products found. <a href="create.php">Create one</a>.</p>
    <?php else: ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price ($)</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($products as $p): ?>
                <tr>
                    <td>
                        <?php if ($p['image']): ?>
                            <img src="uploads/<?= htmlspecialchars($p['image']) ?>" width="80" height="80">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($p['product_name']) ?></td>
                    <td><?= htmlspecialchars($p['description']) ?></td>
                    <td><?= htmlspecialchars($p['price']) ?></td>
                    <td>
                        <a href="update-product.php?id=<?= $p['id'] ?>">Edit</a> |
                        <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</main>

<?php require './includes/footer.php'; ?>
