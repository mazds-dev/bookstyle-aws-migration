<?php
// Session start
startSessionIfNotStarted();

// Cart quantity logic
$totalItems = calculateCartTotalItems();

$pageTitle = $pageTitle ?? 'Payment Cancelled';

ob_start();
?>
<div style="text-align: center; padding: 3rem 1rem;">
    <h2 style="color: #e53935;">Payment Cancelled</h2>
    <p style="font-size: 1.2rem; margin-top: 1rem;">Unfortunately, your payment was not completed.</p>
    <p>You will be redirected to the cart page in 5 seconds...</p>
    <a href="/cart" style="display: inline-block; margin-top: 1.5rem; padding: 0.8rem 1.5rem; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 4px;">Return to Cart Now</a>
</div>
<script>
    setTimeout(() => {
        window.location.href = "/cart";
    }, 6000);
</script>
<?php
$content = ob_get_clean();

// Now reuse the main layout
include __DIR__ . '/layouts/mainLayout.php';
