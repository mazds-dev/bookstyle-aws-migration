<?php
require_once __DIR__ . '/../helpers/session_helper.php';

// Check if user is logged in
function isLoggedIn() {
    startSessionIfNotStarted();
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
}

function requireLogin() {
    startSessionIfNotStarted();
    if (!isset($_SESSION['user'])) {
        $_SESSION['flash'] = [
            'type' => 'warning',
            'message' => 'Please log in to continue.'
        ];
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header("Location: /login");
        exit;
    }
}

function currentUser() {
    startSessionIfNotStarted();
    return $_SESSION['user'] ?? null;
}

/**
 * Require a specific role or array of roles
 * 
 * @param string|array $roles Single role (string) or multiple accepted roles (array)
 * @param string $redirectTo Where to redirect if role requirement not met
 */
function requireRole($roles, $redirectTo = '/login') {
    startSessionIfNotStarted();
    
    // Make sure user is logged in
    if (!isset($_SESSION['user'])) {
        $_SESSION['flash'] = [
            'type' => 'warning',
            'message' => 'Please log in to continue.'
        ];
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header("Location: /login");
        exit;
    }
    
    $userRole = $_SESSION['user']['role'] ?? '';
    
    // Convert single role to array for consistent handling
    if (!is_array($roles)) {
        $roles = [$roles];
    }
    
    // Check if user's role is in the list of accepted roles
    if (!in_array($userRole, $roles)) {
        // Redirect based on the user's actual role
        if ($userRole === 'admin') {
            header("Location: /dashboard/admin/index");
        } elseif ($userRole === 'barber') {
            header("Location: /dashboard/barber/index");
        } else {
            header("Location: /dashboard/user/index");
        }
        exit;
    }
}

function currentUserId() {
    startSessionIfNotStarted();
    return $_SESSION['user']['id'] ?? null;
}

/**
 * Get current user's role
 */
function currentUserRole() {
    startSessionIfNotStarted();
    return $_SESSION['user']['role'] ?? null;
}

/**
 * Check if current user has a specific role
 */
function hasRole($role) {
    $userRole = currentUserRole();
    return $userRole === $role;
}

/**
 * Check if user has any of the specified roles
 * 
 * @param array $roles Array of roles to check against
 * @return boolean
 */
function hasAnyRole($roles) {
    if (!is_array($roles)) {
        $roles = [$roles];
    }
    
    $userRole = currentUserRole();
    return in_array($userRole, $roles);
}
?>