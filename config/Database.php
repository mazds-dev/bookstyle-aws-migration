<?php
/**
 * Database Connection (Singleton)
 * 
 * This file establishes a connection to the database using PDO.
 * The Singleton pattern ensures only one instance of the connection is used.
 */

namespace Config;

use PDO;
use PDOException;
use Dotenv\Dotenv;

class Database {
    private static $instance = null; // Holds the instance of the database
    private $connection; // The actual PDO connection

    private function __construct() {
        // Load environment variables from the .env file
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Assuming .env is in the root directory
        $dotenv->load();

        // Get credentials from enviroment variables
        $host = $_ENV['DATABASE_HOST']; 
        $dbname = $_ENV['DATABASE_NAME']; 
        $username = $_ENV['DATABASE_USER']; 
        $password = $_ENV['DATABASE_PASS'];

        try {
            // Establish a connection using PDO
            $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    /**
     * Returns the single instance of the database connection.
     * 
     * @return Database Singleton instance
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * Returns the PDO connection.
     * 
     * @return PDO Database connection
     */
    public function getConnection() {
        return $this->connection;
    }
}
?>
    
