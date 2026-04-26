<?php
/**
 * Service Controller
 * 
 * This controller handles requests related to the barbershop services.
 * It acts as an intermediary between the Service and Product models (retrieving data)
 * and the home view (rendering the homepage).
 * 
 * Responsibilities:
 * - Fetches and prepares a list of available services.
 * - Fetches available products to be displayed on the homepage.
 * - Loads the homepage view with both services and products.
 */

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ProductModel;

class HomeController {
    private $serviceModel; // Store the service model instance

    public function __construct() {
        // Create an instance of the Service model
        $this->serviceModel = new ServiceModel();
    }

    /**
     * Render the homepage with services and products
    */
    public function renderHomePage() {
        // Fetch services
        $services = $this->serviceModel->getAllServices(); 
        
        // Load products
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();
    
        // Sets dynamic title (can be used in <title> tag in layout)
        $pageTitle = "Welcome to JB Barbershop";
    
        // Buffer the homepage content
        ob_start();
        require __DIR__ . "/../../app/views/home.php";
        $content = ob_get_clean();
    
        // Render layout with the content inside
        require __DIR__ . "/../../app/views/layouts/mainLayout.php";
    }
}
 