<?php
session_start(); // Ensure session is started

$booking = $_SESSION['booking'] ?? null;

// Flash message
$type = $_SESSION['flash']['type'] ?? 'success';
$message = $_SESSION['flash']['message'] ?? 'Thank you!';
unset($_SESSION['flash']);

// Determine heading based on context
if (strpos(strtolower($message), 'account') !== false) {
    $title = '🎉 Registration Successful!';
} elseif (strpos(strtolower($message), 'booking') !== false || $booking) {
    $title = '✔️ Booking Confirmed!';
} else {
    $title = '✔️ Payment Successful!';
}

// Build content
$content = '
    <div style="text-align: center; padding: 3rem 1rem;">
        <h2 style="color: #28a745;">' . $title . '</h2>
        <p style="font-size: 1.2rem; margin-top: 1rem;">' . htmlspecialchars($message) . '</p>
';

if ($booking) {
    $content .= '
        <div style="margin-top: 2rem;">
            <h3 style="color: #333;">Booking Details</h3>
            <p><strong>Service:</strong> ' . htmlspecialchars($booking['service_name']) . '</p>
            <p><strong>Date:</strong> ' . htmlspecialchars($booking['date']) . '</p>
            <p><strong>Time:</strong> ' . htmlspecialchars($booking['time']) . '</p>
        </div>
    ';
}

$content .= '
    <p>You will be redirected to the homepage in 7 seconds...</p>
    <a href="/" style="display: inline-block; margin-top: 1.5rem; padding: 0.8rem 1.5rem; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 4px;">Return Home Now</a>
</div>
<script>
    setTimeout(() => {
        window.location.href = "/";
    }, 7000);
</script>
';

include __DIR__ . '/layouts/mainLayout.php';
