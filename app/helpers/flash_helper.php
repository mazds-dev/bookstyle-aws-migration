<?php
function flash($type) {
    if (!empty($_SESSION[$type])) {
        $message = $_SESSION[$type];
        unset($_SESSION[$type]);

        // Use the flash message partial
        $type = htmlspecialchars($type);
        $message = htmlspecialchars($message);
        include __DIR__ . '/../views/partials/flashMessage.php';
    }
}
