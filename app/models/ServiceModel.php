<?php
/**
 * Service Model
 * 
 * Responsible for handling all interactions with the "services" table in the database.
 */

namespace App\Models; 

use Config\Database;

use PDO;

class ServiceModel {
    private $db; // Private database connection property

    public function __construct() {
        // Get database connection instance (Singleton pattern)
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Get all services from the database.
     * 
     * @return array List of all available services.
     */
    public function getAllServices() {
        $stmt = $this->db->prepare("SELECT * FROM services ORDER BY name ASC"); // Prepare SQL query
        $stmt->execute(); // Execute the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return all services as an associative array
    }

    /**
     * Get a single service by ID.
     * 
     * @param int $id The ID of the service.
     * @return array|null The service details or null if not found.
     */
    public function getServiceById($id) {
        $stmt = $this->db->prepare("SELECT * FROM services WHERE id = ?"); // Prepare SQL query
        $stmt->execute([$id]); // Execute query with provided ID
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return service data
    }

    /**
     * Create Service
     * 
     * 
     * 
     */
    public function createService($name, $duration, $price) {
        $sql = "INSERT INTO services (name, duration, price) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([$name, $duration, $price])) {
            return $this->db->lastInsertId();  // Return the ID of the new service
        }
        return false;
    }

    /**
     * Update Service
     * 
     * 
     * 
     */
    public function updateService($id, $name, $duration, $price) {
        $sql = "UPDATE services SET name = ?, duration = ?, price = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $duration, $price, $id]);
    }

    /**
     * Delete Service
     * 
     * 
     * 
     */
    public function deleteService($id) {
        $sql = "DELETE FROM services WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

        /**
     * Delete Service
     * 
     * 
     * 
     */
    public function editService($id, $name, $duration, $price) {
        $sql = "UPDATE services SET name = ?, duration = ?, price = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$name, $duration, $price, $id]);
    }
    
    
    
}

