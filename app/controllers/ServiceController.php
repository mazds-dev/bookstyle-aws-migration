<?php

namespace App\Controllers;

use App\Models\ServiceModel;

class ServiceController {
    
    public function __construct() {
        requireRole('admin'); // Makes sure only admin can access
    }

    // List all services
    public function services() {
        $serviceModel = new ServiceModel();
        $services = $serviceModel->getAllServices();  // Get all services

        // Load the view to list services
        require __DIR__ . '/../views/dashboard/admin/services.php';
    }

    // Add a new service
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $duration = $_POST['duration'];
            $price = $_POST['price'];

            // Create the service using the model
            $serviceModel = new ServiceModel();
            $serviceModel->createService($name, $duration, $price);

            // Redirect after adding the service
            header('Location: /dashboard/admin/services');
            exit;
        }
    }

    // Edit an existing service
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) $_POST['id'];
            $name = trim($_POST['name']);
            $duration = (int) $_POST['duration'];
            $price = (float) $_POST['price'];
    
            $serviceModel = new ServiceModel();
            $serviceModel->updateService($id, $name, $duration, $price);
    
            header('Location: /dashboard/admin/services');
            exit;
        }
    }
    

    // Delete a service
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
            $id = (int) $_POST['delete_id'];
    
            $serviceModel = new ServiceModel();
            $serviceModel->deleteService($id);
    
            // Redirect back to the service list page
            header('Location: /dashboard/admin/services');
            exit;
        }
    }
}
