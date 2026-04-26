<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | BookStyle Barbershop</title>
    <link rel="stylesheet" href="/assets/css/auth.css?ver=<?= time(); ?>">
</head>
<body class="auth-body">
<div class="auth-overlay"></div>
    <div class="auth-container">
        <div class="auth-logo">
            <img src="/assets/images/barbershop_logo_white.png" alt="BookStyle Logo">
        </div>

        <div class="auth-header">
            <h2>Welcome Back!</h2>
            <p>Log in to manage your appointments or shop for grooming products.</p>
            <a href="/home" class="close-btn" title="Cancel and return home">×</a>
        </div>

        <!-- Flash messages for notifications -->
        <?php require_once __DIR__ . '/../../helpers/flash_helper.php'; ?>
        <?php flash('success'); ?>
        <?php flash('error'); ?>

        <form method="POST" action="/authenticate" class="auth-form">
            <input type="text" name="username" placeholder="Username" required autofocus />

            <input type="password" name="password" placeholder="Password" required />
            <a href="#" class="forgot-password">Forgot password?</a>

            
            <button type="submit">Log In</button>
        </form>

        <div class="auth-footer">
            <p>New here? <a href="/register">Create an account</a></p>
        </div>
    </div>

</body>
</html>
