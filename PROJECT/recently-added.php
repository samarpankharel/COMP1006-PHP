<?php
session_start();
require_once 'config/database.php';
require_once 'product.php';
include 'includes/header.php';

$db = new Database();
$conn = $db->connect();

// Fetch latest 10 products
$stmt = $conn->prepare("SELECT * FROM products ORDER BY created_at DESC LIMIT 10");
$stmt->execute();
$products = $stmt->fetchAll();
?>
<link rel="stylesheet" href="assets/styles.css">
<main>
    <section class="product-showcase">
        <h2>Recently Added Products</h2>
        <div class="product-grid">
            <?php if (count($products) === 0): ?>
                <p>No products have been added yet.</p>
            <?php else: ?>
                <?php foreach ($products as $p): ?>
                    <div class="product-card">
                        <?php if (!empty($p['image'])): ?>
                            <img src="uploads/<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['product_name']) ?>">
                        <?php else: ?>
                            <img src="assets/img/placeholder.png" alt="No Image">
                        <?php endif; ?>
                        <h3><?= htmlspecialchars($p['product_name']) ?></h3>
                        <p>$<?= htmlspecialchars($p['price']) ?></p>
                        <p><?= htmlspecialchars($p['description']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
