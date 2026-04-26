<?php
/**
 * ProductController
 *
 * This controller manages product-related operations within the barbershop website.
 * It connects the Product model to the relevant views and handles display logic
 * for both the product listings and individual product details.
 * 
 * Responsibilities:
 * - Retrieves and displays all available products.
 * - Handles rendering of single product detail pages.
 * - Loads appropriate views or redirects to 404 if a product is not found.
 * - Handles cart actions (add, view, clear).
 *
 */

namespace App\Controllers;

use App\Models\ProductModel;

class ProductController {
    private $productModel;

    public function __construct() {
        // Initialize the Product model
        $this->productModel = new ProductModel();
    }
    // Method to add product to cart
    public function addToCart() {
        session_start();
        
        // Get the product details from the POST request
        $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $productPrice = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);

        // Create a product array
        $product = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice
        ];

        // Add the product to the cart (session)
        $_SESSION['cart'][] = $product;

        // Redirect to the cart page or show a success message
        header('Location: /cart');
        exit;
    }

    /**
     * Display all products
     */
    public function showProducts() {
        // Fetch products
        $products = $this->productModel->getAllProducts();
    
        // Set title
        $pageTitle = "Our Products";
    
        // Capture view output
        ob_start();
        require __DIR__ . "/../../app/views/products.php";
        $content = ob_get_clean();
    
        // Render layout
        require __DIR__ . "/../../app/views/layouts/mainLayout.php";
    }
    

    /**
     * Display details for a single product
     */
    public function showProductDetails($productId) {
        $product = $this->productModel->getProductById($productId);
    
        if ($product) {
            $pageTitle = $product['name'] . " - Product Details";
            
            ob_start();
            require __DIR__ . "/../../app/views/product_details.php";
            $content = ob_get_clean();
            
            require __DIR__ . "/../../app/views/layouts/mainLayout.php";
        } else {
            header("Location: /404");
            exit;
        }
    }
    

    /**
     * View the cart
     */
    public function viewCart() {
        session_start();
        $cart = $_SESSION['cart'] ?? [];
    
        $pageTitle = "Your Cart";
    
        ob_start();
        require __DIR__ . "/../../app/views/cart.php";
        $content = ob_get_clean();
    
        require __DIR__ . "/../../app/views/layouts/mainLayout.php";
    }
    
    
    /**
     * Clear the cart
     */
    public function clearCart() {
        session_start();
        unset($_SESSION['cart']);  // Remove all items from the cart
        header("Location: /cart");
        exit();
    }
}
