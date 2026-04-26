<?php
namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\ServiceModel;
use App\Models\OrderModel;
use App\Models\ProductModel;

// require_once __DIR__ . '/../helpers/auth.php';

class AdminController {
    public function __construct() {
        requireRole('admin'); // Makes sure only admin can access
    }

    public function products() {
        $productModel = new \App\Models\ProductModel();
        $products = $productModel->getAllProducts(); // fetch products
    
        require __DIR__ . '/../views/dashboard/admin/products.php'; // make sure this file exists
    }
    

    public function addProduct() {
        requireRole('admin'); // Ensure only admins can access

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize form inputs
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);

            // Handle image upload
            $imagePath = null;
            if (!empty($_FILES['image']['tmp_name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $imageName;

                // Create uploads folder if it doesn't exist
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imagePath = '/uploads/' . $imageName; // URL path for display
                }
            }

            // Save to database
            $productModel = new \App\Models\ProductModel();
            $productModel->addProduct($name, $description, $price, $stock, $imagePath);

            // Redirect back
            header("Location: /dashboard/admin/products");
            exit;
        }
    }

    public function editProduct() {
        requireRole('admin');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) $_POST['id'];
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
            $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
            $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT);
    
            // Optional: handle image upload
            $imagePath = null;
            if (!empty($_FILES['image']['tmp_name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                $imageName = time() . '_' . basename($_FILES['image']['name']);
                $targetPath = $uploadDir . $imageName;
    
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
    
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imagePath = '/uploads/' . $imageName;
                }
            }
    
            $productModel = new \App\Models\ProductModel();
            $productModel->updateProduct($id, $name, $description, $price, $stock, $imagePath);
    
            header("Location: /dashboard/admin/products");
            exit;
        }
    }

    public function deleteProduct() {
        requireRole('admin');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $id = (int) $_POST['delete_id'];
    
            $productModel = new \App\Models\ProductModel();
            $productModel->deleteProduct($id);
    
            header("Location: /dashboard/admin/products");
            exit;
        }
    }
    

    public function bookings() {
        $bookingModel = new BookingModel();
        $bookings = $bookingModel->getAllBookings(); 

        require __DIR__ . '/../views/dashboard/admin/bookings.php';
    }

    public function services() {
        $serviceModel = new ServiceModel();
        $services = $serviceModel->getAllServices(); 

        require __DIR__ . '/../views/dashboard/admin/services.php';
    }

    public function users() {
        $userModel = new \App\Models\UserModel();
        $users = $userModel->getAllUsers(); // You'll need to define this in UserModel
    
        require __DIR__ . '/../views/dashboard/admin/users.php';
    }

    public function revenue()
    {
        // Create an instance of the model to fetch data (you can add more logic here to query real data)
        $bookingModel = new BookingModel();

        // For now, we'll use static placeholder data or fetch real data from the model
        // Example static data to match the placeholders from the earlier page holder
        $data = [
            'totalBookings' => 28,
            'serviceRevenue' => 560.00,
            'productRevenue' => 320.00,
            'totalRevenue' => 880.00,
        ];

        // Pass this data to the view (revenue.php)
        // The 'data' variable can be accessed inside revenue.php for rendering the page
        include __DIR__ . '/../views/dashboard/admin/revenue.php'; // Path to the revenue page
    }

    public function deleteBooking() {
        requireRole('admin');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $id = (int) $_POST['delete_id'];

            $bookingModel = new \App\Models\BookingModel();
            $success = $bookingModel->deleteBooking($id);

            if ($success) {
                header("Location: /dashboard/admin/bookings");
            } else {
                // Optional: display error or log
                header("Location: /dashboard/admin/bookings?error=1");
            }
            exit;
        }
    }

    public function editBooking() {
        requireRole('admin');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
            $id = (int) $_POST['edit_id'];
            $bookingModel = new \App\Models\BookingModel();
            $bookingToEdit = $bookingModel->getBookingById($id);
    
            require __DIR__ . '/../views/dashboard/admin/editBooking.php';
        } else {
            // Optional fallback
            header('Location: /dashboard/admin/bookings');
            exit;
        }
    }

    public function updateBooking() {
        requireRole('admin');
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int) $_POST['id'];
            $customerName = $_POST['customer_name'];
            $phone = $_POST['phone'];
            $serviceId = (int) $_POST['service_id'];
            $barberId = (int) $_POST['barber_id'];
            $date = $_POST['booking_date'];
            $time = $_POST['booking_time'];
            $status = $_POST['status'];
    
            $bookingModel = new \App\Models\BookingModel();
            $success = $bookingModel->updateBooking($id, $customerName, $phone, $serviceId, $barberId, $date, $time, $status);
    
            if ($success) {
                $_SESSION['successMessage'] = 'Booking updated successfully.';
            } else {
                $_SESSION['errorMessage'] = 'Failed to update booking.';
            }
        }
    
        header("Location: /dashboard/admin/bookings");
        exit;
    }
    
    
    

    

}

