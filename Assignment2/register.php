<?php
require 'auth.php';
require 'database.php';
require 'user.php';

$error = '';
$success = '';

// Redirect if already logged in
if (isLoggedIn()) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $imageName = '';

    // Validation
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long!";
    } else {
        $db = (new Database())->connect();
        $user = new User($db);

        // Check if email already exists
        if ($user->getByEmail($email)) {
            $error = "Email already exists!";
        } else {
            // Handle image upload
            if (!empty($_FILES['image']['name'])) {
                $imageName = time() . "_" . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
            }

            // Create user
            if ($user->create($name, $email, $password, $imageName)) {
                $success = "Registration successful! You can now login.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}

require 'header.php';
?>
    <main>
        <div class="auth-container">
            <h2>Create Your Account</h2>
            <?php if ($error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success-message"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" class="auth-form">
                <input type="text" name="name" required placeholder="Full Name">
                <input type="email" name="email" required placeholder="Email Address">
                <input type="password" name="password" required placeholder="Password (min 6 characters)">
                <input type="password" name="confirm_password" required placeholder="Confirm Password">
                <input type="file" name="image" accept="image/*" placeholder="Profile Image (optional)">
                <button type="submit">Register</button>
            </form>

            <p class="auth-link">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </main>
<?php require 'footer.php'; ?>