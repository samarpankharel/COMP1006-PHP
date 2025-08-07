<?php include 'includes/header.php'; ?>

<main>
    <section class="register-section">
        <h2>Create an Account</h2>
        <form class="register-form" method="POST" action="create-register.php">
            <label for="fullname">Full Name:</label>
            <input type="text" id="fullname" name="fullname" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="submit-btn">Register</button>
        </form>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
