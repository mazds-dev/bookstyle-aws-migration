<?php

namespace App\Models;

use Config\Database;
use PDO;
use Exception;

/**
 * Product Model
 * 
 * This model represents the product data in the application. It interacts with the database to 
 * fetch products, retrieve product details, and manage the product-related operations.
 * 
 * Key Methods:
 * - getAllProducts: Retrieves all products from the database with stock available.
 * - getProductById: Retrieves a specific product by its ID.
 * 
 * The model uses the database connection provided by the Database class to interact with the 
 * products table.
 * 
 */

class ProductModel {
    private $db;

    public function __construct() {
        // Get the database connection via the singleton
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Fetch all products from the database.
     *
     * @return array|false Array of products or false if no products found
     */
    public function getAllProducts() {
        try {
            $query = "SELECT * FROM products WHERE stock > 0"; // Only show products with stock available
            $stmt = $this->db->prepare($query);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return products as an associative array
        } catch (Exception $e) {
            error_log("Error fetching products: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Fetch a specific product by its ID.
     *
     * @param int $id Product ID
     * @return array|false Product data or false if not found
     */
    public function getProductById($id) {
        try {
            $query = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC); // Return a single product
        } catch (Exception $e) {
            error_log("Error fetching product by ID: " . $e->getMessage());
            return false;
        }
    }

    public function addProduct($name, $description, $price, $stock, $imageUrl = null) {
        $sql = "INSERT INTO products (name, description, price, stock, image_url, created_at)
                VALUES (:name, :description, :price, :stock, :image_url, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':stock' => $stock,
            ':image_url' => $imageUrl
        ]);
    }
    
    public function updateProduct($id, $name, $description, $price, $stock, $imageUrl = null) {
        $sql = "UPDATE products SET 
                    name = :name,
                    description = :description,
                    price = :price,
                    stock = :stock" .
                    ($imageUrl ? ", image_url = :image_url" : "") . 
                " WHERE id = :id";
    
        $stmt = $this->db->prepare($sql);
        $params = [
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':price' => $price,
            ':stock' => $stock
        ];
    
        if ($imageUrl) {
            $params[':image_url'] = $imageUrl;
        }
    
        $stmt->execute($params);
    }
    
    public function deleteProduct($id) {
        try {
            // Prepare the delete statement
            $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Ensure the ID is bound as an integer
    
            // Execute the query
            $stmt->execute();
            
            // Check if any rows were affected
            if ($stmt->rowCount() === 0) {
                throw new Exception('No product found with the given ID.');
            }
        } catch (Exception $e) {
            // Handle any error (e.g., log it or display a friendly message)
            // Log error (You can use your logger or just var_dump for debugging)
            error_log($e->getMessage());
            throw new Exception('An error occurred while deleting the product.');
        }
    }
    
    
}
?>
