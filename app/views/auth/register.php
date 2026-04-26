<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Join Our Barbershop Family</title>
    <link rel="stylesheet" href="assets/css/auth.css?ver=<?= time(); ?>">
</head>
<body class="auth-body">
    <div class="auth-overlay"></div>
    <div class="auth-container">
        <!-- Close Button (optional) -->
        <a href="/login" class="close-btn">&times;</a>

        <!-- Header -->
        <div class="auth-header">
            <h2>Welcome to Our Barbershop!</h2>
            <p>Join us and experience the best grooming services in town.</p>
        </div>

        <!-- Error message (if any) -->
        <?php require_once __DIR__ . '/../../helpers/flash_helper.php'; ?>
        <?php flash('success'); ?>
        <?php flash('error'); ?>

        <!-- Registration Form -->
        <form class="auth-form" action="/register_user" method="POST">
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="tel" name="phone" placeholder="Phone Number" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            
            <button type="submit">Register</button>
        </form>

        <!-- Footer -->
        <div class="auth-footer">
            <p>Already have an account? <a href="/login">Login here</a></p>
        </div>
    </div>
</body>
</html>
