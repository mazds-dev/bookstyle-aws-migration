<link rel="stylesheet" href="assets/css/styles.css">

<section id="products">
    
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-item">
                <img src="/<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p>Price: €<?= number_format($product['price'], 2) ?></p>
                <!-- <p>Stock: <?= $product['stock'] ?></p> -->
                
                <!-- Form to submit to the CartController -->
                <form action="/add_to_cart" method="POST">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                    <input type="hidden" name="price" value="<?= $product['price'] ?>">
                    <input type="hidden" name="type" value="product">
                    <button type="submit" class="add-to-cart">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</section>
