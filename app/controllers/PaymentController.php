<?php
/**
 *
 * This controller manages the payment processing flow using Stripe for both services and products.
 * It handles the creation of Stripe Checkout sessions and redirects the user to the payment gateway.
 * 
 * Responsibilities:
 * - Processes payment for a service booking via Stripe.
 * - Handles the creation of Stripe Checkout sessions for products in the cart.
 * - Redirects users to the appropriate Stripe Checkout page for payment.
 * - Handles success and failure redirection after payment attempts.
 * 
 */

namespace App\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
 
 /**
  * Handles Stripe Checkout session creation and redirects to Stripe.
  */
class PaymentController
{
    public function __construct()
    {
        // Set the Stripe API key for authentication
        Stripe::setApiKey(getenv('STRIPE_SECRET_KEY') ?: $_ENV['STRIPE_SECRET_KEY']);
    }

    /**
     * Determines the type of checkout (service, product, or both),
    * then triggers the corresponding Stripe checkout method.
    */
    public function processPayment()
    {
  
        require_once __DIR__ . '/../helpers/auth_helper.php';
        require_once __DIR__ . '/../helpers/session_helper.php';
        startSessionIfNotStarted();

        $_SESSION['redirect_after_login'] = $_SESSION['redirect_after_login'] ?? '/checkout';

        requireLogin(); // Login check here

        // Check if user is logged in
        if (!isset($_SESSION['user'])) {
            $_SESSION['warning'] = 'Please log in to proceed to payment.';
            $_SESSION['redirect_after_login'] = '/cart'; 
            header("Location: /stripe_checkout");
            exit;
        }
    
        $lineItems = [];
    
        // Check if we have actual products (not services) in the cart
        $hasProduct = false;
        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                if (isset($item['type']) && $item['type'] === 'product') {
                    $hasProduct = true;
                    break;
                }
            }
        }
        
        $hasService = !empty($_SESSION['booking']);
    
        // Set the correct checkout type
        if ($hasProduct && $hasService) {
            $_SESSION['checkout_type'] = 'combined'; // both service and product
        } elseif ($hasService) {
            $_SESSION['checkout_type'] = 'service'; // only service
        } elseif ($hasProduct) {
            $_SESSION['checkout_type'] = 'product'; // only product
        } else {
            echo "Nothing to checkout.";
            exit;
        }
        
        // Debug: Check what type is setting
        error_log("Checkout type set to: " . $_SESSION['checkout_type']);
    
    
        // Add service line item if booking exists in session
        if ($hasService) {
            $serviceModel = new \App\Models\ServiceModel();
            $service = $serviceModel->getServiceById($_SESSION['booking']['service_id']);
    
            if ($service) {
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => ['name' => $service['name']],
                        'unit_amount' => $service['price'] * 100,
                    ],
                    'quantity' => 1, // Service is always 1 quantity
                ];
            }
        }
    
        // Add product items from cart — skip service if it's already added
        if ($hasProduct) {
            foreach ($_SESSION['cart'] as $item) {

                // Skip if this is the booked service (already added above)
                if (
                    $hasService &&
                    isset($item['id']) &&
                    $item['id'] == $_SESSION['booking']['service_id'] &&
                    $item['type'] === 'service'
                ) {
                    continue;
                }

                $quantity = isset($item['qty']) ? (int)$item['qty'] : 1;
    
                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => ['name' => $item['name']],
                        'unit_amount' => $item['price'] * 100,
                    ],
                    'quantity' => $quantity,
                ];
            }
        }
    
        try {
            $checkoutSession = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => "https://c00288302.candept.com/payment_success?session_id={CHECKOUT_SESSION_ID}",
                'cancel_url' => "https://c00288302.candept.com/payment_cancel",
            ]);
    
            // Log checkout type and session data for debugging
            error_log("Checkout type: " . $_SESSION['checkout_type']);
            error_log("Stored booking in session: " . print_r($_SESSION['booking'] ?? [], true));
            error_log("Cart: " . print_r($_SESSION['cart'] ?? [], true));
    
            header("Location: " . $checkoutSession->url);
            exit();

        } catch (\Stripe\Exception\ApiErrorException $e) {
            $_SESSION['error'] = 'Payment processing failed. Please try again.';
            error_log("Stripe Error: " . $e->getMessage());
            header("Location: /cart"); // Fallback page
            exit();

            // echo "Stripe error: " . $e->getMessage();
            // error_log($e->getMessage());
            // exit();
        }
    }
    
}
