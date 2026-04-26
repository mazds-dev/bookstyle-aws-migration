<?php
$pageTitle = 'Manage Bookings';

$bookingToEdit = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = (int) $_POST['edit_id'];
    $bookingToEdit = $bookingModel->getBookingById($id);
}

ob_start();
?>

<h2>Manage Bookings</h2>

<?php
$successMessage = $_SESSION['successMessage'] ?? null;
$errorMessage = $_SESSION['errorMessage'] ?? null;
unset($_SESSION['successMessage'], $_SESSION['errorMessage']);
?>


<div class="table-scroll-wrapper">
    <table class="styled-table">

        <!-- Table Header -->
        <thead>
            <tr>
                <th>Customer</th>
                <th>Phone</th>
                <th>Service</th>
                <th>Barber</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <!-- Edit Form Row -->
        <?php if ($bookingToEdit): ?>
        <tr class="form-row">
            <form method="POST" action="/dashboard/admin/booking/edit">
                <input type="hidden" name="id" value="<?= $bookingToEdit['id'] ?>">
                <td><input type="text" class="admin-input" name="customer_name" value="<?= htmlspecialchars($bookingToEdit['customer_name']) ?>" required></td>
                <td><input type="text" class="admin-input" name="phone" value="<?= htmlspecialchars($bookingToEdit['phone']) ?>" required></td>
                <td><input type="number" class="admin-input" name="service_id" value="<?= $bookingToEdit['service_id'] ?>" required></td>
                <td><input type="number" class="admin-input" name="barber_id" value="<?= $bookingToEdit['barber_id'] ?>" required>
                <td><input type="date" class="admin-input" name="booking_date" value="<?= $bookingToEdit['booking_date'] ?>" required></td>
                <td><input type="time" class="admin-input" name="booking_time" value="<?= substr($bookingToEdit['booking_time'], 0, 5) ?>" required></td>
                <td>
                    <select name="status" class="admin-input" required>
                        <?php foreach (['confirmed', 'cancelled', 'completed'] as $status): ?>
                            <option value="<?= $status ?>" <?= $bookingToEdit['status'] === $status ? 'selected' : '' ?>>
                                <?= ucfirst($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <button type="submit" class="admin-btn save">Save</button>
                </td>
            </form>
        </tr>
        <?php endif; ?>

        <!-- Table Data Rows -->
        <?php foreach ($bookings as $booking): ?>
    <tr>
        <td><?= htmlspecialchars($booking['customer_name']) ?></td>
        <td><?= htmlspecialchars($booking['phone']) ?></td>
        <td><?= htmlspecialchars($booking['service_name'] ?? 'N/A') ?></td>
        <td><?= htmlspecialchars($booking['barber_name'] ?? 'No Barber Assigned') ?></td>
        <td><?= formatDate($booking['booking_date']) ?></td>
        <td><?= formatTime($booking['booking_time']) ?></td>
        <td><?= htmlspecialchars($booking['status']) ?></td>
        <td style="white-space: nowrap;">
            <!-- Edit Button -->
            <form method="POST" action="/dashboard/admin/bookings" style="display:inline;">
                <input type="hidden" name="edit_id" value="<?= $booking['id'] ?>">
                <button type="submit" class="admin-btn edit" title="Edit">Edit</button>
            </form>

            <!-- Delete Button -->
            <form method="POST" action="/dashboard/admin/booking/delete" style="display:inline;" onsubmit="return confirm('Delete this booking?');">
                <input type="hidden" name="delete_id" value="<?= $booking['id'] ?>">
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
?>
