<?php
namespace App\Models;

use Config\Database;

class TransactionModel {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    public function saveTransaction($sessionId, $amount, $type, $status) {
        try {
            $sql = "INSERT INTO transactions (session_id, amount, type, status, created_at) 
                    VALUES (?, ?, ?, ?, NOW())";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$sessionId, $amount, $type, $status]);
            
            return $this->db->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Database error in saveTransaction: " . $e->getMessage());
            return false;
        }
    }
}