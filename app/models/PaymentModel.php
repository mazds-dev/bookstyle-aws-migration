<?php
namespace App\Models;

use Config\Database;
use PDOException;
use PDO;

class PaymentModel {
    private $db; // Private database connection property

    public function __construct() {
        // Get database connection instance (Singleton pattern)
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Save payment details to the database.
     * 
     * @param string $sessionId The session ID from Stripe.
     * @param string $paymentIntentId The payment intent ID from Stripe.
     * @param string $email The email of the customer.
     * @param float $amountTotal The total amount paid.
     * @return bool True if successful, false otherwise.
     */
    public function savePaymentDetails($sessionId, $paymentIntentId, $email, $amountTotal) {
        try {
            $query = "INSERT INTO payments (session_id, payment_intent_id, email, amount_total, created_at) 
                      VALUES (:session_id, :payment_intent_id, :email, :amount_total, NOW())";
            $stmt = $this->db->prepare($query);

            // Bind parameters
            $stmt->bindParam(':session_id', $sessionId);
            $stmt->bindParam(':payment_intent_id', $paymentIntentId);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':amount_total', $amountTotal);

            return $stmt->execute(); // Return true if successful, false otherwise
        } catch (PDOException $e) {
            // Log database errors for debugging
            file_put_contents(__DIR__ . "/log.txt", date("Y-m-d H:i:s") . " - DB Error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false; // Return false if an error occurs
        }
    }

    /**
     * Save purchased products to the database.
     * 
     * @param string $sessionId The session ID from Stripe.
     * @param array $lineItems Array of line items (products).
     * @return bool True if successful, false otherwise.
     */
    public function saveProductsPurchased($sessionId, $lineItems) {
        try {
            foreach ($lineItems as $item) {
                $productName = $item['description']; // Product description
                $productPrice = $item['amount_total'] / 100; // Convert from cents to dollars
                $productQuantity = $item['quantity']; // Product quantity

                $query = "INSERT INTO products_purchased (session_id, product_name, price, quantity) 
                          VALUES (:session_id, :product_name, :price, :quantity)";
                $stmt = $this->db->prepare($query);

                // Bind parameters
                $stmt->bindParam(':session_id', $sessionId);
                $stmt->bindParam(':product_name', $productName);
                $stmt->bindParam(':price', $productPrice);
                $stmt->bindParam(':quantity', $productQuantity);

                $stmt->execute(); // Execute query for each product
            }

            return true; // Return true if successful
        } catch (PDOException $e) {
            // Log database errors for debugging
            file_put_contents(__DIR__ . "/log.txt", date("Y-m-d H:i:s") . " - DB Error: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            return false; // Return false if an error occurs
        }
    }
}
