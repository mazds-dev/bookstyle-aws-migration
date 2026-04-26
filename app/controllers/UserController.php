<?php
namespace App\Controllers;
startSessionIfNotStarted();
use App\Models\BookingModel;
require_once __DIR__ . '/../helpers/auth_helper.php';

class UserController {
    ############################################################################
    public function profile() {
        // Allow both regular users and barbers to view their profiles
        requireRole(['user', 'barber']); 
        require_once __DIR__ . '/../views/dashboard/user/profile.php';
    }
    ############################################################################
    public function bookings() {
        // Only users can view their bookings (not barbers)
        requireRole('user');
        
        $userId = currentUserId();
        
        if (!$userId) {
            header("Location: /login");
            exit;
        }
       
        $bookingModel = new BookingModel();
        $upcomingBooking = $bookingModel->getUpcomingBooking($userId);
        $pastBookings = $bookingModel->getPastBookings($userId);
       
        include __DIR__ . '/../views/dashboard/user/bookings.php';
    }
   
    ############################################################################
    // Amend Booking
    public function amendBooking() {
        requireLogin();
        
        // Check if the user has permission to amend bookings
        if (!hasAnyRole(['user', 'admin'])) {
            $_SESSION['error'] = "You don't have permission to amend bookings.";
            header("Location: /dashboard");
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            $bookingId = $_POST['booking_id'];
            $newBookingTime = $_POST['booking_time'];
            $newServiceId = $_POST['service_id'];
            $newBarberId = $_POST['barber_id'];
           
            $bookingModel = new BookingModel();
           
            $success = $bookingModel->amendBooking($bookingId, $newBookingTime, $newServiceId, $newBarberId);
           
            if ($success) {
                header("Location: /dashboard/user/bookings");
                exit;
            } else {
                $_SESSION['error'] = "Error amending the booking.";
            }
        }
    }
    ############################################################################
    // Cancel Booking
    public function cancelBooking() {
        requireLogin();
        
        // Check if the user has permission to cancel bookings
        if (!hasAnyRole(['user', 'admin', 'barber'])) {
            $_SESSION['error'] = "You don't have permission to cancel bookings.";
            header("Location: /dashboard");
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
            $bookingId = $_POST['booking_id'];
           
            $bookingModel = new BookingModel();
           
            $success = $bookingModel->deleteBooking($bookingId);
           
            if ($success) {
                header("Location: /dashboard/user/bookings");
                exit;
            } else {
                $_SESSION['error'] = "Error canceling the booking.";
            }
        }
    }

}

?>