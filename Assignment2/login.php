<?php
require 'auth.php';
require 'database.php';
require 'user.php';

$error = '';

// Redirect if already logged in
if (isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = (new Database())->connect();
    $user = new User($db);
    $userData = $user->login($email, $password);

    if ($userData) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['name'];
        $_SESSION['user_email'] = $userData['email'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}

require 'header.php';
?>
    <main>
        <div class="auth-container">
            <h2>Login to Your Account</h2>
            <?php if ($error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" class="auth-form">
                <input type="email" name="email" required placeholder="Email Address">
                <input type="password" name="password" required placeholder="Password">
                <button type="submit">Login</button>
            </form>

            <p class="auth-link">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </main>
<?php require 'footer.php'; ?>