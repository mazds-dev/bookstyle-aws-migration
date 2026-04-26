<?php

function render($viewPath, $pageTitle = 'JB Barbershop', $data = []) {
    extract($data); // This makes keys like ['user' => ...] become $user
    
    // Start output buffering: everything that's echoed will be saved in memory
    ob_start();

    // Load the view (which can echo HTML or use PHP variables)
    include $viewPath;

    // Store the rendered content into a variable
    $content = ob_get_clean();

    // Check if it's an admin page or not by user role
    
    $isAdminPage = isset($user['role']) && $user['role'] === 'admin';

    // Load the correct layout based on user role

    if ($isAdminPage) {
        include __DIR__ . '/../views/layouts/adminLayout.php';  // Load admin layout
    } else {
        include __DIR__ . '/../views/layouts/userLayout.php';   // Load user layout
    }
}


