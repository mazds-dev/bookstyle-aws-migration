<?php

// Statement to simplify controller references
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\BookController;
use App\Controllers\PaymentController;
use App\Controllers\ProductController;
use App\Controllers\CartController;
use App\Controllers\CheckoutController;
use App\Controllers\UserController;
use App\Controllers\AdminController;
use App\Controllers\DashboardController;
use App\Controllers\ServiceController;

// Parse the requested URL path
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

if ($uri === '' || $uri === 'index.php') {
    $uri = 'home';
}

// Route Handling using a switch statement
switch ($uri) {
    // ############################################## Home Section #####################################################
    case '':
    case 'home':
        // Load the homepage with available services
        $controller = new HomeController();
        $controller->renderHomePage();
        break;

    // ############################################## Auth Section #####################################################
    case 'login':
        $controller = new AuthController();
        $controller->showLoginForm(); // show the login page
        break;

    case 'authenticate':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AuthController();
            $controller->handleLogin(); // process login
        } else {
            header("Location: /login");
        }
        break;

    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;

    case 'account':
        $controller = new \App\Controllers\AuthController();
        $controller->redirectToDashboard();
        break;
        

        
    // ############################################## Register Section #################################################
    case 'register':
        $controller = new AuthController();
        $controller->showRegisterForm(); // show the registration form
        break;

    case 'register_user':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new AuthController();
            $controller->handleRegister(); // process the registration form
        } else {
            header("Location: /register");
        }
        break;
    
    // ############################################### Dashboard - Admin / User Section ################################

    case 'dashboard/user/index':
        $controller = new DashboardController();
        $controller->showUserDashboard();
        break;

    case 'dashboard/user/profile':
        $controller = new UserController();
        $controller->profile();
        break;

    case 'dashboard/user/bookings':
        $controller = new UserController();
        $controller->Bookings();
        break;

    case 'dashboard/user/bookings/amend':
        $controller = new UserController();
        $controller->amendBooking();
        break;

    case 'dashboard/user/bookings/cancel':
        $controller = new UserController();
        $controller->cancelBooking();
        break;
        
    
    // Admin route for dashboard
    case 'dashboard/admin/index':
        $controller = new DashboardController();
        $controller->showAdminDashboard();
        break;
    
    // Route to handle CRUD actions for services
    case 'dashboard/admin/services':
        $controller = new ServiceController();
        $controller->services();  
        break;

    case 'dashboard/admin/service/add':
        $controller = new ServiceController();
        $controller->add();   
        break;

    case 'dashboard/admin/service/edit':
        $controller = new ServiceController();
        $controller->edit();   
        break;

    case 'dashboard/admin/bookings':
        $controller = new AdminController();
        $controller->bookings();
        break;

    case 'dashboard/admin/booking/delete':
        $controller = new AdminController();
        $controller->deleteBooking();
        break;

    case 'dashboard/admin/booking/edit':
        $controller = new AdminController();
        $controller->updateBooking();
        break;
        
        
    
    case 'dashboard/admin/products':
        $controller = new AdminController();
        $controller->products();
        break;

    case 'dashboard/admin/product/add':
        $controller = new AdminController();
        $controller->addProduct();
        break;
        
    case 'dashboard/admin/product/edit':
        $controller = new AdminController();
        $controller->editProduct();
        break;
    
    case 'dashboard/admin/product/delete':
        $controller = new AdminController();
        $controller->deleteProduct();
        break;
    
    case 'dashboard/admin/services':
        $controller = new AdminController();
        $controller->services();
        break;  

    case 'dashboard/admin/users':
        $controller = new AdminController();
        $controller->users();
        break;    

    case 'dashboard/admin/revenue':
        $controller = new AdminController();
        $controller->revenue();
        break; 

    // ############################################## Bookings Section #################################################
    case 'book':
        // Handle the booking request
        $controller = new BookController();
        $controller->handleBooking();
        break;

    case 'add_booking_details':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (session_status() == PHP_SESSION_NONE) session_start();
    
            $_SESSION['booking'] = [
                'service_id'    => $_POST['service_id'],
                'service_name'  => $_POST['service_name'],
                'service_price' => $_POST['service_price'],
                'barber_id'     => $_POST['barber_id'],
                'date'          => $_POST['date'],
                'time'          => $_POST['time'],
            ];
    
            $_SESSION['checkout_type'] = 'service';
    
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
    
            // ✅ Use a composite key here too
            $cartKey = 'service_' . $_POST['service_id'];
            $_SESSION['cart'][$cartKey] = [
                'id'    => $_POST['service_id'],
                'name'  => $_POST['service_name'],
                'price' => $_POST['service_price'],
                'quantity' => 1,
                'type'  => 'service'
            ];
    
            header("Location: /cart");
            exit;
        }
        break;
        

    case 'api/booked_times':
        $controller = new BookController();
        $controller->fetchBookedTimes();
        break;

    // ############################################## Products Section #################################################
    case 'products':
        $controller = new ProductController();
        $controller->showProducts(); // Viewing all products
        break;

    // Viewing a single product's details
    case 'product':
        $controller = new ProductController();
        $productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($productId) {
            $controller->showProductDetails($productId);
        } else {
            header("Location: /404");
            exit;
        }
        break;

    // ############################################## Cart Section #####################################################
    // Cart page
    case 'cart':
        $controller = new CartController();
        $controller->showCart();
        break;    

    // Cart add actions
    case 'add_to_cart':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $controller = new CartController();
            $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $productPrice = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $productType = $_POST['type'] ?? 'product';
            
            if ($productId && $productName && $productPrice) {
                $controller->addToCart($productId, $productName, $productPrice, $productType);
            } else {
                header("Location: /404");
                exit;
            }
        }
        break;

    // Remove item from cart
    case 'remove_from_cart':
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
            $controller = new CartController();
            $controller->removeFromCart($_POST['id']);
        } else {
            header("Location: /404");
            exit;
        }
        break;
        
    case 'remove_service':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new CartController();
            $controller->removeService();
        } else {
            http_response_code(405);
            echo "Method Not Allowed";
        }
        break;
    
    // ############################################## Stripe - Payment Section #########################################

    case 'stripe_checkout':
        error_log("stripe_checkout route hit, method: " . $_SERVER["REQUEST_METHOD"]);
        
        $controller = new PaymentController();
        $controller->processPayment(); // Run for both GET and POST (or just GET)
        break;
    

    case 'payment_success':
        $controller = new CheckoutController();
        $controller->handleSuccess();
        break;

    case 'thank_you':
        require_once __DIR__ . '/../app/views/thank_you.php';
        break;
        
    case 'payment_cancel':
        $cancelView = __DIR__ . '/../app/views/payment_cancel.php';
        if (file_exists($cancelView)) {
            require $cancelView;
        } else {
            http_response_code(404);
            echo "<h2>Payment cancel page not found..</h2>";
        }
        break;      

    // ############################################### Default - 404 Section ###########################################
    case '404':
        http_response_code(404);
        require __DIR__ . '/../app/views/404.php';
        break;

    default:
        http_response_code(404);
        require __DIR__ . '/../app/views/404.php';
        exit;
    
    // ############################################### Debug Section ###################################################
    case 'reset_session':
        session_start();
        session_destroy();
        header("Location: /home");
        exit;
        break;
    
    case 'debug_session':
        session_start();
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
        echo "<a href='/products'>Go to Products</a> | ";
        echo "<a href='/reset_session'>Reset Session</a>";
        exit;
        break;
}
?>
