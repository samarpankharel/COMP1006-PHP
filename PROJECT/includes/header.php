<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="A simple Buying and Selling Market Website">
    <meta name="keywords" content="market, buy, sell, ecommerce">
    <meta name="author" content="Samarpan Kharel">
    <link rel="icon" href="/assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="/assets/styles.css">
    <title>MarketPlace</title>
</head>
<body>
<header>
    <div class="header-top">
        <a href="/index.php">
            <img src="/assets/img/logo.png" alt="Market Logo" class="logo">
        </a>
        <div class="header-text">
            <h1>MarketPlace</h1>
            <p>Buy and Sell Products Easily</p>
        </div>
    </div>
    <nav>
        <ul class="nav-links">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/section/About.php">About</a></li>
            <li><a href="/section/Register.php">Register</a></li>
            <li><a href="/content.php">Products</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="/auth.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="hero-content">
        <h2>Welcome to MarketPlace</h2>
        <p>Discover great deals, sell your items, and connect with buyers instantly!</p>
    </div>
</header>
</body>
</html>
