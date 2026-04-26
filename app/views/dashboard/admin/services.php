<?php
$pageTitle = 'Manage Services';

$serviceToEdit = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = (int) $_POST['edit_id'];
    $serviceToEdit = $serviceModel->getServiceById($id);
}

ob_start();
?>

<h2>Manage Services</h2>

<div class="table-scroll-wrapper">
<table class="styled-table">

        <?php if (!$serviceToEdit): ?>
        <tr class="form-row">
            <form method="POST" action="/dashboard/admin/service/add">
                <td>
                    <input type="text" class="admin-input" name="name" placeholder="Service name"required>
                </td>
                <td>
                    <input type="number" class="admin-input" name="duration" placeholder="Minutes" required>
                </td>
                <td>
                    <input type="number" class="admin-input" name="price" placeholder="Price" required>
                </td>
                <td>
                    <button type="submit" class="admin-btn add" title="Add">Add New</button>
                </td>
            </form>
        </tr>
        <?php endif; ?>

        <thead>
            <tr>
                <th>Service Name</th>
                <th>Duration (Aprox.)</th>
                <th>Price (€)</th>
                <th>Actions</th>
            </tr>
        </thead>

        <!-- Condicional to edit services -->
        <?php if ($serviceToEdit): ?>
            <tr class="form-row">
                <form method="POST" action="/dashboard/admin/service/edit">
                    <input type="hidden" name="id" value="<?= $serviceToEdit['id'] ?>">
                    <td>
                        <input type="text" class="admin-input" name="name" value="<?= htmlspecialchars($serviceToEdit['name']) ?>" required>
                    </td>
                    <td>
                        <input type="number" class="admin-input" name="duration" value="<?= (int)$serviceToEdit['duration'] ?>" required>
                    </td>
                    <td>
                        <input type="number" class="admin-input" name="price" value="<?= htmlspecialchars($serviceToEdit['price']) ?>" required>
                    </td>
                    <td>
                        <button type="submit" class="admin-btn save">Save</button>
                    </td>
                </form>
            </tr>
            <?php endif; ?>

        <!-- loop through services -->
        <?php foreach ($services as $service): ?>
        <tr>
            <td><?= htmlspecialchars($service['name']) ?></td>
            <td><?= (int)$service['duration'] ?></td>
            <td>€<?= number_format($service['price'], 2) ?></td>
            <td style="white-space:nowrap">
                <!-- EDIT button in its own form -->
                <form method="POST" action="/dashboard/admin/services" style="display:inline;">
                    <input type="hidden" name="edit_id" value="<?= $service['id'] ?>">
                    <button type="submit" class="admin-btn edit" title="Edit">Edit</button>
                </form>


                <!-- DELETE button in its own form -->
                <form method="POST" action="/dashboard/admin/service/delete" style="display:inline;" onsubmit="return confirm('Delete this service?')">
                    <input type="hidden" name="delete_id" value="<?= $service['id'] ?>">
                    <button type="submit" class="admin-btn delete" title="Delete">X</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/adminLayout.php';
