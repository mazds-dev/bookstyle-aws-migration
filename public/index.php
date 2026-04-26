<?php

ob_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load composer autoload
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/helpers/session_helper.php';
require_once __DIR__ . '/../app/helpers/cart_helper.php';
require_once __DIR__ . '/../app/helpers/send_email.php';
require_once __DIR__ . '/../app/helpers/flash_helper.php';
require_once __DIR__ . '/../app/helpers/auth_helper.php';
require_once __DIR__ . '/../app/helpers/render_helper.php';
require_once __DIR__ . '/../app/helpers/formatDateTime_helper.php';



use Dotenv\Dotenv;

// Clear any pre-existing environment variables
putenv('STRIPE_SECRET_KEY');
$_ENV['STRIPE_SECRET_KEY'] = null;
$_SERVER['STRIPE_SECRET_KEY'] = null;

// Load .env file using createImmutable
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Test: Output the loaded STRIPE_SECRET_KEY
//var_dump(getenv('STRIPE_SECRET_KEY'));
//var_dump($_ENV['STRIPE_SECRET_KEY']);
//var_dump($_SERVER['STRIPE_SECRET_KEY']);

// Include the routes file that contains all the route definitions and logic
require_once __DIR__ . '/../routes/web.php';
?>
