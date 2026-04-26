<?php

namespace App\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\TransactionModel;
use App\Models\BookingModel;
use App\Models\OrderModel;

class CheckoutController
{
    public function __construct()
    {
        Stripe::setApiKey(getenv('STRIPE_SECRET_KEY') ?: $_ENV['STRIPE_SECRET_KEY']);
    }
    ####################################################################################################################
    public function handleSuccess()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
    
        if (!isset($_GET['session_id'])) {
            throw new \Exception("No session ID found.");
        }
    
        $sessionId = $_GET['session_id'];
    
        try {
            $session = Session::retrieve($sessionId);
    
            error_log("Stripe Metadata Dump: " . print_r($session->metadata, true));
    
            if ($session->payment_status !== 'paid') {
                throw new \Exception("Payment not completed.");
            }
    
            $checkoutType = $_SESSION['checkout_type'] ?? '';
            $transactionModel = new TransactionModel();
            $transactionId = $transactionModel->saveTransaction(
                $session->id,
                $session->amount_total / 100,
                $checkoutType,
                'completed'
            );
    
            if (!$transactionId) {
                throw new \Exception("Transaction save failed.");
            }
    
            // Restore or update session user from Stripe metadata
            $metadata = $session->metadata;
            if (!isset($_SESSION['user'])) {
                $_SESSION['user'] = [];
            }
    
            if (!empty($metadata)) {
                $_SESSION['user']['id'] = $metadata['user_id'] ?? ($_SESSION['user']['id'] ?? null);
                $_SESSION['user']['name'] = $metadata['name'] ?? ($_SESSION['user']['name'] ?? 'Guest User');
                $_SESSION['user']['phone'] = $metadata['phone'] ?? ($_SESSION['user']['phone'] ?? 'Not Provided');
    
                error_log("Session user restored/updated from Stripe metadata: " . print_r($_SESSION['user'], true));
            }
    
            // Inject customer info into booking and fallback info
            if (!empty($_SESSION['booking']) && isset($_SESSION['user'])) {
                $_SESSION['booking']['customer_name'] = $_SESSION['user']['name'] ?? 'Guest User';
                $_SESSION['booking']['phone'] = $_SESSION['user']['phone'] ?? 'Not Provided';
            }
    
            if (!isset($_SESSION['customer_info']) && isset($_SESSION['user'])) {
                $_SESSION['customer_info'] = [
                    'name' => $_SESSION['user']['name'] ?? 'Guest',
                    'phone' => $_SESSION['user']['phone'] ?? 'N/A',
                ];
            }
    
            switch ($checkoutType) {
                case 'service':
                    $this->handleServiceBooking($_SESSION['booking'] ?? [], $transactionId);
                    break;
                case 'product':
                    $customerInfo = $_SESSION['customer_info'] ?? ($_SESSION['booking'] ?? []);
                    $this->handleProductOrder($_SESSION['cart'] ?? [], $customerInfo, $transactionId);
                    break;
                case 'combined':
                    $this->handleServiceBooking($_SESSION['booking'] ?? [], $transactionId);
                    $customerInfo = $_SESSION['customer_info'] ?? ($_SESSION['booking'] ?? []);
                    $this->handleProductOrder($_SESSION['cart'] ?? [], $customerInfo, $transactionId);
                    break;
                default:
                    error_log("Unknown checkout type: $checkoutType");
            }
    
            $_SESSION['success'] = "Payment successful!";
            $this->clearSession();
            header("Location: /thank_you");
            exit();
    
        } catch (\Exception $e) {
            error_log("Checkout error: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
            $_SESSION['error'] = "Payment processing failed.";
            header("Location: /payment_cancel");
            exit();
        }
    }
    ####################################################################################################################
    private function clearSession()
    {
        unset($_SESSION['booking'], $_SESSION['cart'], $_SESSION['checkout_type'], $_SESSION['customer_info']);
    }

    ####################################################################################################################
    private function handleServiceBooking($bookingData, $transactionId)
    {
        if (empty($bookingData) || !isset($bookingData['service_id'], $bookingData['date'], $bookingData['time'], $bookingData['barber_id'])) {
            error_log("Service booking data is missing or incomplete: " . print_r($bookingData, true));
            return false;
        }
    
        error_log("Processing service booking (raw input): " . print_r($bookingData, true));
    
        $customerName = $bookingData['customer_name'] ?? ($_SESSION['user']['name'] ?? 'Guest User');
        $phone = $bookingData['phone'] ?? ($_SESSION['user']['phone'] ?? 'Not Provided');
        $userId = $_SESSION['user']['id'] ?? null;
    
        $bookingModel = new BookingModel();
    
        return $bookingModel->saveBooking(
            $bookingData['service_id'],
            $customerName,
            $phone,
            $bookingData['date'],
            $bookingData['time'],
            $transactionId,
            $bookingData['barber_id'] ?? null,
            $userId
        );
    }
    
    
    ####################################################################################################################
    private function handleProductOrder($cartItems, $customerInfo, $transactionId)
    {
        if (empty($cartItems)) {
            error_log("Attempted to handle product order with empty cart.");
            return false;
        }

        $customerName = $customerInfo['name'] ?? 'Guest Shopper';
        $customerPhone = $customerInfo['phone'] ?? 'Not Provided';

        error_log("Processing product order for: {$customerName}, Phone: {$customerPhone}");
        error_log("Cart contents: " . print_r($cartItems, true));

        $orderModel = new OrderModel();
        $orderId = $orderModel->createOrder($customerName, $customerPhone, $transactionId);

        if (!$orderId) {
            error_log("Order creation failed for transaction: {$transactionId}");
            return false;
        }

        $itemsAdded = 0;
        foreach ($cartItems as $item) {
            if (!empty($item['id']) && isset($item['price'], $item['quantity'])) {
                $quantity = max(1, (int)$item['quantity']);
                $added = $orderModel->addOrderItem($orderId, $item['id'], $item['price'], $quantity);

                if ($added) {
                    $itemsAdded++;
                } else {
                    error_log("Failed to add item to order: Product ID {$item['id']}");
                }
            } else {
                error_log("Invalid cart item skipped: " . print_r($item, true));
            }
        }

        if ($itemsAdded === 0) {
            error_log("Order ID {$orderId} created with no valid items.");
        }

        error_log("Order processed successfully. Order ID: {$orderId}, Items Added: {$itemsAdded}");
        return $orderId;
    }
}
