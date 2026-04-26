<?php

// Handles saving customer product orders into the database

namespace App\Models;

use Config\Database;

class OrderModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function createOrder($customerName, $customerPhone, $transactionId, $userId = null) {
        try {
            $sql = "INSERT INTO orders (customer_name, customer_phone, transaction_id, user_id, status, created_at) 
                    VALUES (?, ?, ?, ?, 'completed', NOW())";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$customerName, $customerPhone, $transactionId, $userId]);
            
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Database error in createOrder: " . $e->getMessage());
            return false;
        }
    }
    
    
    public function addOrderItem($orderId, $productId, $price, $quantity) {
        try {
            $sql = "INSERT INTO order_items (order_id, product_id, price, quantity) 
                    VALUES (?, ?, ?, ?)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$orderId, $productId, $price, $quantity]);
            
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Database error in addOrderItem: " . $e->getMessage());
            return false;
        }
    }
}