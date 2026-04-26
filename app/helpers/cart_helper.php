<?php

if (!function_exists('calculateCartTotalItems')) {
    function calculateCartTotalItems(): int {
        $totalItems = 0;

        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $item) {
                $totalItems += isset($item['qty']) ? $item['qty'] : 1;
            }
        }

        if (isset($_SESSION['service'])) {
            $totalItems += 1;
        }

        return $totalItems;
    }
}
