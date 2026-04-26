<?php

// Stripe Secret API Key
\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

// Get the session ID from the query parameters
$session_id = $_GET['session_id'];

if (!$session_id) {
    echo "Session ID missing!";
    exit();
}

try {
    // Retrieve the session object using the session ID
    $session = \Stripe\Checkout\Session::retrieve($session_id);

    // Check if the payment was successful
    if ($session->payment_status == 'paid') {
        // Start session
        

        // Clear cart, service, and booking session data
        unset($_SESSION['cart']);
        unset($_SESSION['service']);
        unset($_SESSION['booking']);

        error_log("After unset in payment_success: " . print_r($_SESSION, true));


        // Set message
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Booking confirmed!'];

        // Redirect to thank you page
        header("Location: /thank_you");
        exit;

    } else {
        echo "Payment failed for session ID: " . $session_id;
    }
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle errors related to the Stripe API
    echo "Error: " . $e->getMessage();
}
