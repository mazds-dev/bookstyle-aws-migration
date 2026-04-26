<?php
namespace App\Models;

use PDO;
use Config\Database;

class UserModel {

    private $db;
    
    public function __construct() {
        // DB connection
        $this->db = Database::getInstance()->getConnection();  
    }

    public function createUser($username, $passwordHash, $name, $email, $phone, $role = 'user') {
        $sql = "INSERT INTO users (username, password, name, email, phone, role, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([$username, $passwordHash, $name, $email, $phone, $role])) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['username' => $username]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    
}
