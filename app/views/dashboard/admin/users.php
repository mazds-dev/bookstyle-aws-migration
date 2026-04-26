<?php
$pageTitle = 'Manage Users';

// Editing logic (optional)
$userToEdit = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $editId = (int) $_POST['edit_id'];
    // Assuming $userModel is available
    $userToEdit = $userModel->getUserById($editId);
}

ob_start();
?>

<h2>Manage Users</h2>

<div class="table-scroll-wrapper">
    <table class="styled-table">
        <!-- Add User Form (Only show if NOT editing) -->
        <?php if (!$userToEdit): ?>
        <tr class="form-row">
            <form method="POST" action="/dashboard/admin/user/add">
                <td><input type="text" name="name" class="admin-input" placeholder="Full Name" required></td>
                <td><input type="email" name="email" class="admin-input" placeholder="Email" required></td>
                <td>
                    <select name="role" class="admin-input" required>
                        <option value="customer">Customer</option>
                        <option value="barber">Barber</option>
                        <option value="admin">Admin</option>
                    </select>
                </td>
                <td colspan="2">
                    <button type="submit" class="admin-btn add">Add User</button>
                </td>
            </form>
        </tr>
        <?php endif; ?>

        <!-- Table Headers -->
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Registered</th>
                <th>Actions</th>
            </tr>
        </thead>

        <!-- Edit Form Row -->
        <?php if ($userToEdit): ?>
        <tr class="form-row">
            <form method="POST" action="/dashboard/admin/user/edit">
                <input type="hidden" name="id" value="<?= $userToEdit['id'] ?>">
                <td><input type="text" name="name" class="admin-input" value="<?= htmlspecialchars($userToEdit['name']) ?>" required></td>
                <td><input type="email" name="email" class="admin-input" value="<?= htmlspecialchars($userToEdit['email']) ?>" required></td>
                <td>
                    <select name="role" class="admin-input" required>
                        <option value="customer" <?= $userToEdit['role'] === 'customer' ? 'selected' : '' ?>>Customer</option>
                        <option value="barber" <?= $userToEdit['role'] === 'barber' ? 'selected' : '' ?>>Barber</option>
                        <option value="admin" <?= $userToEdit['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </td>
                <td><?= date('Y-m-d', strtotime($userToEdit['created_at'])) ?></td>
                <td><button type="submit" class="admin-btn save">Save</button></td>
            </form>
        </tr>
        <?php endif; ?>

        <!-- Existing Users Loop -->
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['role']) ?></td>
            <td><?= formatDate($user['created_at']) ?></td>
            <td style="white-space:nowrap">
                <!-- Edit button -->
                <form method="POST" action="/dashboard/admin/users" style="display:inline;">
                    <input type="hidden" name="edit_id" value="<?= $user['id'] ?>">
                    <button type="submit" class="admin-btn edit">Edit</button>
                </form>

                <!-- Delete button -->
                <form method="POST" action="/dashboard/admin/user/delete" style="display:inline;" onsubmit="return confirm('Delete this user?')">
                    <input type="hidden" name="delete_id" value="<?= $user['id'] ?>">
                    <button type="submit" class="admin-btn delete">X</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/adminLayout.php';
?>
