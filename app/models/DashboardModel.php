<?php

namespace App\Models;

use Config\Database;
use PDO;
use Exception;

/**
 * Dashboard Model
 * 
 * This model fetches user-specific dashboard data such as booking stats.
 * 
 * Responsibilities:
 * - Get total number of bookings for a user.
 * - Get recent bookings by date.
 */

class DashboardModel {
    private $db;

    public function __construct() {
        // Get the database connection via the singleton
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Fetch recent bookings
     */
    public function getDashboardData($userId) {
        try {
            $query = "SELECT * FROM bookings WHERE user_id = :user_id ORDER BY booking_date DESC LIMIT 5";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':user_id', $userId, \PDO::PARAM_INT);
            $stmt->execute();

            // Return the last 5 bookings for the user
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            error_log("Error fetching dashboard data: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get the total number of bookings for a specific user
     */
    public function getUserBookingCount($userId) {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) AS total FROM bookings WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching booking count: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get recent bookings for the user, ordered by latest
     */
    public function getRecentBookings($userId, $limit = 5) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM bookings WHERE user_id = ? ORDER BY date DESC LIMIT ?");
            $stmt->bindValue(1, $userId, PDO::PARAM_INT);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error fetching recent bookings: " . $e->getMessage());
            return false;
        }
    }
}
