<?php
namespace App\Models;

use Config\Database;
use PDO;
use PDOException;

class BookingModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();  
    }

    // Save a new booking, including barber info
    public function saveBooking($serviceId, $customerName, $phone, $date, $time, $transactionId, $barberId, $userId = null) {
        try {
            $sql = "INSERT INTO bookings (service_id, customer_name, phone, booking_date, booking_time, transaction_id, user_id, barber_id, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'confirmed')";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                $serviceId,
                $customerName,
                $phone,
                $date,
                $time,
                $transactionId,
                $userId,
                $barberId
            ]);
    
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Database error in saveBooking: " . $e->getMessage());
            return false;
        }
    }

    public function amendBooking($bookingId, $newBookingTime, $newServiceId, $newBarberId) {
        try {
            $stmt = $this->db->prepare("
                UPDATE bookings 
                SET booking_time = ?, service_id = ?, barber_id = ?
                WHERE id = ?
            ");
            $stmt->execute([$newBookingTime, $newServiceId, $newBarberId, $bookingId]);
    
            return true;  // Return true if the booking was amended successfully
        } catch (PDOException $e) {
            error_log("Database error in amendBooking: " . $e->getMessage());
            return false;  // Return false if there was an error
        }
    }
    

    // Cancel a booking by deleting it
    public function cancelBooking($bookingId) {
        try {
            $sql = "DELETE FROM bookings WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$bookingId]);

            return $stmt->rowCount() > 0; // Returns true if a row was deleted
        } catch (PDOException $e) {
            error_log("Database error in cancelBooking: " . $e->getMessage());
            return false;
        }
    }
    

    // Get booked times by BARBER and DATE
    public function getBookedTimesByBarberAndDate($barberId, $date) {
        try {
            $stmt = $this->db->prepare("
                SELECT booking_time 
                FROM bookings 
                WHERE barber_id = ? 
                  AND booking_date = ? 
                  AND status = 'confirmed'
            ");
            $stmt->execute([$barberId, $date]);

            $bookedTimes = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Convert to H:i format (e.g., "14:00")
            return array_map(function ($time) {
                return date('H:i', strtotime($time));
            }, $bookedTimes);
        } catch (PDOException $e) {
            error_log("Database error in getBookedTimesByBarberAndDate: " . $e->getMessage());
            return [];
        }
    }

    // List of barbers for dropdowns
    public function getBarbers() {
        $stmt = $this->db->prepare("SELECT id, name FROM users WHERE role = 'barber'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get bookings by user ID
    public function getBookingsByUserId($userId) {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single booking by booking ID
    public function getBookingById($id) {
        $stmt = $this->db->prepare("SELECT * FROM bookings WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Get all bookings (for admin purposes)
    public function getAllBookings() {
        $stmt = $this->db->prepare("
            SELECT 
                bookings.*, 
                services.name AS service_name, 
                users.name AS barber_name
            FROM bookings
            LEFT JOIN services ON bookings.service_id = services.id
            LEFT JOIN users ON bookings.barber_id = users.id AND users.role = 'barber'
            ORDER BY bookings.booking_date DESC, bookings.booking_time DESC;
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    

    // Delete booking by ID (for canceling)
    public function deleteBooking($bookingId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM bookings WHERE id = ?");
            return $stmt->execute([$bookingId]);
        } catch (PDOException $e) {
            error_log("Database error in deleteBooking: " . $e->getMessage());
            return false;
        }
    }
    
    // Get past bookings for a user
    public function getPastBookings($userId) {
        $stmt = $this->db->prepare("
            SELECT bookings.*, services.name AS service_name, users.name AS barber_name
            FROM bookings
            JOIN services ON bookings.service_id = services.id
            JOIN users ON bookings.barber_id = users.id
            WHERE bookings.user_id = ?
            AND (CONCAT(bookings.booking_date, ' ', bookings.booking_time)) < NOW()
            ORDER BY bookings.booking_date DESC, bookings.booking_time DESC
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
    
    
    
    // Get the user's upcoming booking
    public function getUpcomingBooking($userId) {
        $sql = "
            SELECT bookings.*, services.name AS service_name, users.name AS barber_name
            FROM bookings
            JOIN services ON bookings.service_id = services.id
            JOIN users ON bookings.barber_id = users.id
            WHERE bookings.user_id = ? 
            AND (booking_date > CURDATE() OR (booking_date = CURDATE() AND booking_time > NOW()))
            ORDER BY booking_date ASC, booking_time ASC
            LIMIT 1
        ";
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$userId]);
    
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Fetch the upcoming booking
    }
    
    public function updateBooking($id, $customerName, $phone, $serviceId, $barberId, $date, $time, $status) {
        $stmt = $this->db->prepare("
            UPDATE bookings
            SET customer_name = ?, phone = ?, service_id = ?, barber_id = ?, booking_date = ?, booking_time = ?, status = ?
            WHERE id = ?
        ");
        return $stmt->execute([$customerName, $phone, $serviceId, $barberId, $date, $time, $status, $id]);
    }
    
}
?>
