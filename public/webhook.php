webhook.php
<?php
//This file will receive webhook events from Stripe, extract the necessary details, and send an email

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Load required dependencies (PHPMailer and Stripe)
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../helpers/send_email.php'; // Email sending function

// Read the raw request body from Stripe
$payload = @file_get_contents("php://input");
$event = json_decode($payload, true);

// Log the webhook event (for debugging)
file_put_contents(__DIR__ ."/log.txt", date("Y-m-d H:i:s") . " - Received Event: " . json_encode($event) . PHP_EOL, FILE_APPEND);

if ($event && isset($event['type'])) {
    if ($event['type'] == 'payment_intent.succeeded') {
        // Handle direct payment intents (if used)
    } elseif ($event['type'] == 'checkout.session.completed') {
        // Handle successful Stripe Checkout transactions
        $session = $event['data']['object'];

        // Retrieve customer email
        $customerEmail = $session['customer_details']['email'] ?? '';

        // Log event
        file_put_contents(__DIR__ . "/log.txt", date("Y-m-d H:i:s") . " - Checkout Session Completed: " . json_encode($event) . PHP_EOL, FILE_APPEND);

        // Send email
        if (!empty($customerEmail)) {
            sendPaymentSuccessEmail($customerEmail);
        }
    }
}

// Respond to Stripe (Stripe expects a 200 status response)
http_response_code(200);
?>
