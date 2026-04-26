<?php
namespace App\Controllers;

use App\Models\UserModel;

class AuthController {
    public function showLoginForm() {
        require_once __DIR__ . '/../views/auth/login.php';
    }
    ################################################################################################
    public function handleLogin() {
        session_start();
    
        // Get POST data
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
    
        // Create an instance of the User model
        $userModel = new UserModel();
    
        // Call the method from the model to fetch user details by username
        $user = $userModel->getUserByUsername($username);
    
        // DEBUG
        error_log("User fetched: " . print_r($user, true));
        // Debug: Check the role of the user
        error_log("User role: " . print_r($user['role'], true)); // Log the user role
    
        if ($user && password_verify($password, $user['password'])) {
            // Password matches, create session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],  // 'admin' or 'user'
                'name' => $user['name'],  // Store user name
                'email' => $user['email'], // Store user email
                'phone' => $user['phone'], // Store user phone
            ];

            // If redirected after trying to book/order, go back there
            if (isset($_SESSION['redirect_after_login'])) {
                unset($_SESSION['flash']); // Clear old flash messages
                $redirectTo = $_SESSION['redirect_after_login'];
                unset($_SESSION['redirect_after_login']); // clean up 
                header("Location: $redirectTo");
                exit;
            }
            
            // Otherwise normal login flow
            // Check if the user is an admin or a regular user and redirect to the correct dashboard
            if ($user['role'] === 'admin') {
                header("Location: /dashboard/admin/index");
            } else {
                header("Location: /dashboard/user/index");
            }

            exit; // Always exit after a header redirect

        } else {
            // Invalid login credentials, show error message
            $_SESSION['error'] = "Invalid login credentials.";
            header("Location: /login");
            exit;
        }
    }

    ################################################################################################

    public function showRegisterForm() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        require_once __DIR__ . '/../views/auth/register.php';
    }
    
    public function handleRegister() {
        session_start();
    
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
    
        if ($password !== $confirmPassword) {
            $_SESSION['error'] = "Passwords do not match.";
            header("Location: /register");
            exit;
        }
    
        $userModel = new \App\Models\UserModel();
        $existingUser = $userModel->getUserByUsername($username);
    
        if ($existingUser) {
            $_SESSION['error'] = "Username already taken.";
            header("Location: /register");
            exit;
        }
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userId = $userModel->createUser($username, $hashedPassword, $name, $email, $phone);
    
        if ($userId) {
            $_SESSION['user'] = [
                'id' => $userId,
                'username' => $username,
                'role' => 'user',
                'name' => $name,
                'phone' => $phone,
            ];
        
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => 'Your account has been created successfully.',
            ];
        
            header("Location: /thank_you");
            exit;
        
        } else {
            $_SESSION['error'] = "Registration failed.";
            header("Location: /register");
            exit;
        }
    }
    
    
    ################################################################################################
    public function isUserLoggedIn() {
        return isset($_SESSION['user']) && !empty($_SESSION['user']);
    }
    
    

    ################################################################################################
    public function logout() {
        session_start();   // Start the session
        session_unset();   // Remove all session variables
        session_destroy(); // Destroy the session completely
        $_SESSION['success'] = "You have successfully logged out.";


        header('Location: /home');  // Redirect to the login page
        exit;
    }
    public function redirectToDashboard() {
        session_start();
    
        if (!isset($_SESSION['user'])) {
            // Not logged in — send to login
            header("Location: /login");
            exit;
        }
    
        $user = $_SESSION['user'];
    
        if ($user['role'] === 'admin') {
            header("Location: /dashboard/admin/index");
        } else {
            header("Location: /dashboard/user/index");
        }
    
        exit;
    }
    
}


?>