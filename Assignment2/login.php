<?php
//Loading the required php files by require:
require 'auth.php';
require 'database.php';
require 'user.php';

$error = '';

// Redirect if already logged in
if (isLoggedIn()) {
    header("Location: index.php");
    exit;
}
//Login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
   //Connect to the database
    $db = (new Database())->connect();
    //Create a user obj
    $user = new User($db);
    //It log in's with the provided user data
    $userData = $user->login($email, $password);
    // For Successful login
    if ($userData) {
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['user_name'] = $userData['name'];
        $_SESSION['user_email'] = $userData['email'];
        header("Location: index.php");
        exit;
        //For failed login
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