<?php
namespace App\Controllers;

use App\Models\DashboardModel;

class DashboardController {
    private $dashboardModel;

    public function __construct() {
        $this->dashboardModel = new DashboardModel();
    }

    // Show the User Dashboard
    public function showUserDashboard() {
        // Ensure the user is logged in
        requireLogin();

        // Get the current user
        $user = currentUser();

        // Fetch user-specific data if necessary
        // For example: $userData = $this->dashboardModel->getUserData($user['id']);

        // Render user dashboard view
        render(__DIR__ . "/../../app/views/dashboard/user/index.php", "User Dashboard", [
            'user' => $user,
            // Other data can be passed as needed
        ]);
    }

    // Show the Admin Dashboard
    public function showAdminDashboard() {
        // Ensure the user is logged in and is an admin
        requireRole('admin');

        // Get the current admin
        $user = currentUser();

        // Fetch admin-specific data if necessary
        // For example: $adminData = $this->dashboardModel->getAdminData($user['id']);

        // Render admin dashboard view
        render(__DIR__ . "/../../app/views/dashboard/admin/index.php", "Admin Dashboard", [
            'user' => $user,
            // Other data can be passed as needed
        ]);
    }
}

    