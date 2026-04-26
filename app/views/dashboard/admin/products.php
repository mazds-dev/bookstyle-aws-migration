<?php
// Set the page title
$pageTitle = 'Manage Products';

// If editing a product, fetch its details
$productToEdit = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = (int) $_POST['edit_id'];
    // This assumes $productModel is available and set before this file is included
    $productToEdit = $productModel->getProductById($id);
}

// Start capturing page content
ob_start();
?>

<h2>Manage Products</h2>

<div class="table-scroll-wrapper">
    <table class="styled-table">

        <!-- If NOT currently editing a product, show the ADD product form -->
        <?php if (!$productToEdit): ?>
        <tr class="form-row">
            <!-- Form to add a new product -->
            <form method="POST" action="/dashboard/admin/product/add" enctype="multipart/form-data">
                <td>
                    <!-- Product name input -->
                    <input type="text" class="admin-input" name="name" placeholder="Product name" required>
                </td>
                <td>
                    <!-- Product description input -->
                    <input type="text" class="admin-input" name="description" placeholder="Description" required>
                </td>
                <td>
                    <!-- Product price input -->
                    <input type="number" step="0.01" class="admin-input" name="price" placeholder="Price" required>
                </td>
                <td>
                    <!-- Product stock input -->
                    <input type="number" class="admin-input" name="stock" placeholder="Stock" required>
                </td>
                <td>
                    <!-- Product image upload -->
                    <input type="file" name="image" accept="image/*" required>
                </td>
                <td>
                    <!-- Submit button -->
                    <button type="submit" class="admin-btn add" title="Add">Add New</button>
                </td>
            </form>
        </tr>
        <?php endif; ?>

        <!-- Table Header -->
        <thead>
            <tr>
                <th>Product</th>
                <th>Description</th>
                <th>Price (€)</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>

        <!-- If editing a product, show a prefilled form instead -->
        <?php if ($productToEdit): ?>
        <tr class="form-row">
            <!-- Form to edit an existing product -->
            <form method="POST" action="/dashboard/admin/product/edit" enctype="multipart/form-data">
                <!-- Hidden ID field -->
                <input type="hidden" name="id" value="<?= $productToEdit['id'] ?>">
                <td>
                    <input type="text" class="admin-input" name="name" value="<?= htmlspecialchars($productToEdit['name']) ?>" required>
                </td>
                <td>
                    <input type="text" class="admin-input" name="description" value="<?= htmlspecialchars($productToEdit['description']) ?>" required>
                </td>
                <td>
                    <input type="number" step="0.01" class="admin-input" name="price" value="<?= $productToEdit['price'] ?>" required>
                </td>
                <td>
                    <input type="number" class="admin-input" name="stock" value="<?= $productToEdit['stock'] ?>" required>
                </td>
                <td>
                    <!-- Update image -->
                    <input type="file" name="image" accept="image/*">
                </td>
                <td>
                    <button type="submit" class="admin-btn save">Save</button>
                </td>
            </form>
        </tr>
        <?php endif; ?>

        <!-- Loop over each product in the list -->
        <?php foreach ($products as $product): ?>
        <tr>
            <!-- Product name -->
            <td><?= htmlspecialchars($product['name']) ?></td>
            <!-- Product description -->
            <td><?= htmlspecialchars($product['description']) ?></td>
            <!-- Price with 2 decimals -->
            <td>€<?= number_format($product['price'], 2) ?></td>
            <!-- Stock quantity -->
            <td><?= $product['stock'] ?></td>
            <!-- Image preview (if exists) -->
            <?php if (!empty($product['image_url'])): ?>
    <!-- Image Preview Container -->
    <td style="text-align: center;">
        <div style="width: 50px; height: 50px; overflow: hidden; border-radius: 4px; margin: 0 auto;">
            <img src="/assets/images/<?= htmlspecialchars($product['image_url']) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>" 
                 style="width: 100%; height: auto; display: block;">
        </div>
    </td>
<?php else: ?>
    <!-- Placeholder when no image is available -->
    <td style="text-align: center;">
        <div style="width: 50px; height: 50px; background: #f0f0f0; text-align: center; line-height: 50px; font-size: 10px; color: #888; margin: 0 auto;">
            N/A
        </div>
    </td>
<?php endif; ?>


            <!-- Action buttons: Edit + Delete -->
            <td style="white-space:nowrap">
                <!-- Edit button posts to same page to load edit form -->
                <form method="POST" action="/dashboard/admin/products" style="display:inline;">
                    <input type="hidden" name="edit_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="admin-btn edit" title="Edit">Edit</button>
                </form>

                <!-- Delete button with confirmation -->
                <form method="POST" action="/dashboard/admin/product/delete" style="display:inline;" onsubmit="return confirm('Delete this product?')">
                    <input type="hidden" name="delete_id" value="<?= $product['id'] ?>">
                    <button type="submit" class="admin-btn delete" title="Delete">X</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>

<?php
// End content buffer and render inside layout
$content = ob_get_clean();
include __DIR__ . '/../../layouts/adminLayout.php';
?>
