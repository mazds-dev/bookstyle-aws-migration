<?php
/**
 * BookController
 * 
 * This controller is responsible for handling the booking process for services. 
 * It interacts with the Service and Booking models to provide the necessary data and functionality 
 * for users to book appointments for services.
 * 
 * Responsibilities:
 * - Fetches the details of a specific service by its ID.
 * - Validates and processes the booking data submitted by the user.
 * - Creates a new booking record in the database.
 * - Handles the display of the booking page for users to select and book a service.
 * 
 */

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\ServiceModel;
use Exception;

class BookController {
    private $serviceModel;
    private $bookingModel;
    private $barberId;

    public function __construct() {
        $this->serviceModel = new ServiceModel();
        $this->bookingModel = new BookingModel(); // Instantiate the BookingModel
    }

    public function handleBooking() {

        // Start the session if it's not already started
        require_once __DIR__ . '/../helpers/session_helper.php';
        startSessionIfNotStarted();

        // Get the service ID from the query parameters
        $serviceId = filter_input(INPUT_GET, 'service_id', FILTER_VALIDATE_INT);
    
        if (!$serviceId || !($service = $this->getServiceById($serviceId))) {
            // If service doesn't exist, redirect to a 404 page
            header("Location: /404");
            exit;
        }

        // Fetch barbers for the booking form
        $barbers = $this->bookingModel->getBarbers();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Sanitize and get the user's booking information
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $time = filter_input(INPUT_POST, 'time', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $barberId = filter_input(INPUT_POST, 'barber_id', FILTER_VALIDATE_INT);

            try {
                // Input validation
                $this->validateBookingInputs($serviceId, $name, $phone, $date, $time);

                // Load CartController and call setCartSession
                require_once __DIR__ . '/CartController.php';
                $cartController = new \App\Controllers\CartController();
                
                // Save the booking and service information to cart
                $cartController->setCartSession([
                    'user_id' => $_SESSION['user']['id'],
                    'service_id' => $serviceId,
                    'service_name' => $service['name'],
                    'service_price' => $service['price'],
                    'service_duration' => $service['duration'], 
                    'name' => $name,
                    'phone' => $phone,
                    'date' => $date,
                    'time' => $time,
                    'barber_id' => $barberId // Added barber selection
                ]);
    
                // Redirect to cart
                header("Location: /cart");
                exit;
    
            } catch (Exception $e) {
                $error = $e->getMessage();
                // Show error with layout
                $pageTitle = "Book a Service";
                ob_start();
                require __DIR__ . '/../views/book.php';
                $content = ob_get_clean();
                require __DIR__ . '/../views/layouts/mainLayout.php';
                return;
            }
        }
    
        // GET: show booking form using layout
        $pageTitle = "Book a Service";
        ob_start();
        require __DIR__ . '/../views/book.php'; // This is where you will use $barbers
        $content = ob_get_clean();
        require __DIR__ . '/../views/layouts/mainLayout.php';
    }
 
    public function getServiceById($id) {
        if (!is_numeric($id) || $id <= 0) return null;
        return $this->serviceModel->getServiceById($id);
    }

    private function validateBookingInputs($serviceId, $name, $phone, $date, $time) {
        if (empty($serviceId) || empty($name) || empty($phone) || empty($date) || empty($time)) {
            throw new Exception("All fields are required.");
        }

        if (!preg_match("/^[a-zA-Z\s]{2,}$/", $name)) {
            throw new Exception("Invalid name.");
        }

        if (!preg_match("/^\+?[0-9]{7,15}$/", $phone)) {
            throw new Exception("Invalid phone number.");
        }

        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
            throw new Exception("Invalid date format.");
        }

        if (!preg_match("/^\d{2}:\d{2}$/", $time)) {
            throw new Exception("Invalid time format.");
        }

        $service = $this->serviceModel->getServiceById($serviceId);
        if (!$service) {
            throw new Exception("Service not found.");
        }
    }

    public function fetchBookedTimes() {
        header('Content-Type: application/json');
    
        // Fetch parameters from the query string
        $barberId = filter_input(INPUT_GET, 'barber_id', FILTER_VALIDATE_INT);
        $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
        // Validate the parameters
        if (!$barberId || !$date) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing barber ID or date']);
            exit;
        }
    
        // Debugging log to verify parameters
        error_log("Fetching booked times for barberId: $barberId, date: $date");
    
        // Fetch the booked times from the BookingModel
        $bookingModel = new \App\Models\BookingModel();
        $bookedTimes = $bookingModel->getBookedTimesByBarberAndDate($barberId, $date);
    
        // Log the result for debugging
        error_log("Found " . count($bookedTimes) . " booked times: " . implode(', ', $bookedTimes));
    
        // Return the result as JSON
        echo json_encode($bookedTimes);
        exit;
    
    }
}