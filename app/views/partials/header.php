<?php
require_once __DIR__ . '/../../helpers/session_helper.php';
require_once __DIR__ . '/../../helpers/cart_helper.php';

startSessionIfNotStarted();

// Check login state directly via session
$isLoggedIn = isset($_SESSION['user']);

// Calculate the total number of items in the cart
$totalItems = calculateCartTotalItems();
?>

<header>
    <div class="branding">
        <a href="/" style="text-decoration: none; color: inherit;">
            <div class="sidebar-logo">
                <a href="/"><img src="/assets/images/barbershop_logo.png" alt="JB Barbershop Logo" class="logo" /></a>
            </div>
        </a>
    </div>
    <nav>
        <a href="/">Home</a>
        <a href="/#services">Services</a>
        <a href="/products">Products</a>
        <a href="/#about">About Us</a>
        <a href="/#footer">Contact</a>
        
        <?php if ($isLoggedIn): ?>
        <a href="/account">My Account</a>
        <a href="/logout">Logout</a>
    <?php else: ?>
        <a href="/login">Login / Register</a>
    <?php endif; ?>

        <a href="/cart">
            Cart:
            <span class="cart-badge"><?= $totalItems ?></span>
        </a>
    </nav>
</header>
