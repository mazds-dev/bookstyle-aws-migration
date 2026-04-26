<?php 
// Start session method
startSessionIfNotStarted();
// Cart quantity logic 
$totalItems = calculateCartTotalItems();
?>

<section id="cart">
    <h2>Your Shopping Cart</h2>

    <?php
    // Checks if there are any products in the cart (not empty)
    $hasCartItems = !empty($_SESSION['cart']);

    // Checks if the user has selected a service appointment 
    $hasService = isset($_SESSION['service']);

    // Ensures that your cart page doesn't display as empty if only one type of item is present
    if ($hasCartItems || $hasService): 
    ?>

    <!-- Cart Table -->
    <table class="cart-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        <?php 
        $totalPrice = 0;
        $serviceId = null;
        $productIds = [];

        // Show the service if it's selected
        if ($hasService): 
            $service = $_SESSION['service'];
            $totalPrice += $service['price'];
            $serviceId = $service['id']; // Save the service ID
        ?>
        <tr>
            <td><?= htmlspecialchars($service['name']) ?></td>
            <td>Service</td>
            <td>1</td>
            <td>€<?= number_format($service['price'], 2) ?></td>
            <td>
                <form action="/remove_service" method="POST">
                    <button class="remove-item">Remove</button>
                </form>
            </td>
        </tr>
        <?php endif; ?>
        
        <?php 
        // Show the products if they're in the cart
        if (!empty($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $item): 
                $quantity = $item['quantity'] ?? 1;
                $itemTotal = $item['price'] * $quantity;
                $totalPrice += $itemTotal;
                $productIds[] = $item['id']; // Collect product IDs
        ?>
        <tr>
            <td><?= htmlspecialchars($item['name']) ?></td>
            <td><?= $item['type'] === 'service' ? 'Service' : 'Product' ?></td>
            <td><?= $item['quantity'] ?? 1 ?></td>
            <td>€<?= number_format($itemTotal, 2) ?></td>
            <td>
                <form action="/remove_from_cart" method="POST">
                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                    <button class="remove-item">Remove</button>
                </form>
            </td>
        </tr>
        <?php 
            endforeach;
        endif; 
        ?>
        </tbody>
    </table>

    <div class="cart-total">
        <p><strong>Total Price: €<?= number_format($totalPrice, 2) ?></strong></p>

        <!-- Dynamically set the checkout type -->
        <form action="stripe_checkout" method="POST">
            <?php if ($hasService && isset($_SESSION['booking'])) : ?>
                <input type="hidden" name="service_id" value="<?= htmlspecialchars($_SESSION['booking']['service_id'] ?? '') ?>">
                <input type="hidden" name="date" value="<?= htmlspecialchars($_SESSION['booking']['date'] ?? '') ?>">
                <input type="hidden" name="time" value="<?= htmlspecialchars($_SESSION['booking']['time'] ?? '') ?>">
            <?php endif; ?>

            <?php foreach ($productIds as $productId): ?>
                <input type="hidden" name="product_id[]" value="<?= htmlspecialchars($productId) ?>">
            <?php endforeach; ?>
            <!-- This hidden input determines the checkout type - It can be one of three values -->
            <input type="hidden" name="checkout_type" value="<?= $hasService && $hasCartItems ? 'combined' : ($hasService ? 'service' : 'product') ?>">

            <button type="submit">Checkout</button>
        </form>

    </div>

    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" style="text-align: center; padding: 20px;">
                        <em>Your cart is empty, browse Products or Book a Service...</em>
                    </td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</section>
