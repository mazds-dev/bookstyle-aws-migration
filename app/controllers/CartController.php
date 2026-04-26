<?php
namespace App\Controllers;

class CartController {

    // Show the cart
    public function showCart()
    {
        startSessionIfNotStarted();

        $cart = $_SESSION['cart'] ?? [];
        $productModel = new \App\Models\ProductModel();
        $cartItems = [];
        $totalPrice = 0;

        foreach ($cart as $key => $item) {
            $type = $item['type'] ?? 'product';
            $quantity = $item['quantity'] ?? 1;

            if ($type === 'product') {
                $product = $productModel->getProductById($item['id']);
            } else {
                $product = $item; // Use service details as-is
            }

            if ($product) {
                $product['total'] = $quantity * $product['price'];
                $product['type'] = $type;
                $product['quantity'] = $quantity;
                $cartItems[] = $product;
                $totalPrice += $product['total'];
            }
        }

        ob_start();
        require __DIR__ . "/../../app/views/cart.php";
        $content = ob_get_clean();
        require __DIR__ . "/../../app/views/layouts/mainLayout.php";
    }

    public function addToCart($id, $name, $price, $type = 'product') {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $cartKey = $type . '_' . $id;

        if (isset($_SESSION['cart'][$cartKey])) {
            $_SESSION['cart'][$cartKey]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$cartKey] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'quantity' => 1,
                'type' => $type
            ];
        }

        $_SESSION['checkout_type'] = 'product';
        header("Location: /cart");
        exit;
    }

    public function removeFromCart($productId) {
        startSessionIfNotStarted();

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['id'] == $productId) {
                    unset($_SESSION['cart'][$key]);
                    break;
                }
            }
        }
        header("Location: /cart");
        exit;
    }

    public function removeService() {
        startSessionIfNotStarted();

        unset($_SESSION['service'], $_SESSION['booking']);

        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                if (isset($item['type']) && $item['type'] === 'service') {
                    unset($_SESSION['cart'][$key]);
                }
            }
        }

        header("Location: /cart");
        exit();
    }

    public function setCartSession(array $postData): void {
        startSessionIfNotStarted();

        $_SESSION['service'] = [
            'id'       => $postData['service_id'] ?? null,
            'name'     => $postData['service_name'] ?? '',
            'price'    => $postData['service_price'] ?? 0,
            'duration' => $postData['service_duration'] ?? 0,
            'date'     => $postData['date'] ?? '',
            'time'     => $postData['time'] ?? '',
            'type'     => 'service'
        ];
    }
}
