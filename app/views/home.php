

<!--
 * Home Page (View)
 * 
 * This is the main landing page of the barbershop website.
 * It includes a section that displays available services dynamically.
-->

<?php
// Ensure $services is defined before this file is loaded
if (!isset($services)) {
    $services = []; // Prevent errors if not set
}

?>
<!-- Hero Section -->
<section class="hero">
    <h2>Welcome to JB Barbershop</h2>
    <p>Book your next haircut today!</p>
    <button id="bookNowBtn">Book Now</button>
</section>

<!-- Services Table -->
<section id="services">
    <h2>Our Services</h2>

    <div class="services-container">
        <table class="services-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Duration (approx.)</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through services and display them in rows -->
                <?php foreach ($services as $service) : ?>
                    <tr>
                        <td><?= htmlspecialchars($service["name"]); ?></td>
                        <td><?= htmlspecialchars($service["duration"]); ?> min.</td>
                        <td>€<?= htmlspecialchars($service["price"]); ?></td>
                        <td><a href="book?service_id=<?= htmlspecialchars($service['id']); ?>">
                        <button class="book-button">BOOK</button></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<!-- Products Section (from partials) -->
<Section>
    <h2>Shop Our Products</h2>
    <?php require_once __DIR__ . "/partials/products_section.php"; ?>
</Section>

<!-- About Us Section -->
<section id="about" class="about-us">
    <h2>About Us</h2>
    <div class="about-text">
        <p>Founded in the heart of the city, JB Barbershop has been a place where tradition meets innovation. With a passion for timeless grooming, we've built a reputation for excellence in every cut and shave. Our skilled barbers dedicate themselves to making each visit a personal experience, ensuring that you leave feeling confident and looking your best.</p>
        
        <p>We’ve always believed in providing more than just a haircut — it’s about building connections.</p>
    </div>

    <div class="about-cta">
        <a href="#services" class="button-link">Explore Our Services</a>
    </div>
</section>





