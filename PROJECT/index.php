<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="A simple Buying and Selling Market Website">
    <meta name="keywords" content="market, buy, sell, ecommerce">
    <meta name="author" content="Samarpan Kharel">
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/styles.css">
    <title>MarketPlace</title>
</head>
<body>

<?php include 'includes/header.php'; ?>

<main>
    <section class="product-showcase">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="assets/img/product1.jpg" alt="IPAD PRO">
                <h3>IPAD PRO</h3>
                <p>$499.99</p>
            </div>
            <div class="product-card">
                <img src="assets/img/product2.jpg" alt="IPHONE">
                <h3>IPHONE</h3>
                <p>$899.99</p>
            </div>
            <div class="product-card">
                <img src="assets/img/product3.jpg" alt="MACBOOK PRO">
                <h3>MACBOOK PRO</h3>
                <p>$1,259.99</p>
            </div>
            <div class="product-card">
                <img src="assets/img/product4.jpg" alt="Bluetooth Headphone">
                <h3>Bluetooth Headphone</h3>
                <p>$39.99</p>
            </div>
            <div class="product-card">
                <img src="assets/img/product5.jpg" alt="Smartphone Headphone with ANC">
                <h3>Smartphone Headphone with ANC</h3>
                <p>$64.99</p>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>