<?php
$pageTitle = 'My Bookings';

// Retrieve upcoming and past bookings
$upcomingBooking = $upcomingBooking ?? null;
$pastBookings = $pastBookings ?? [];

ob_start(); 
?>

<!-- Check for any error messages -->
<?php if (isset($_SESSION['error'])): ?>
    <div class="error"><?= $_SESSION['error'] ?></div>
    <?php unset($_SESSION['error']); // Clear the error after displaying it ?>
<?php endif; ?>

<h2>My Bookings</h2>

<!-- Upcoming Booking Section -->
<h3>Your Upcoming Booking</h3>

<table class="styled-table">
    <thead>
        <tr>
            <th>Service</th>
            <th>Barber</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($upcomingBooking): ?>
            <tr>
                <td><?= htmlspecialchars($upcomingBooking['service_name']) ?></td>
                <td><?= htmlspecialchars($upcomingBooking['barber_name']) ?></td>
                <td><?= formatDate($upcomingBooking['booking_date']) ?></td>
                <td><?= formatTime($upcomingBooking['booking_time']) ?></td>
                <td><?= ucfirst(htmlspecialchars($upcomingBooking['status'])) ?></td>
                <td class="booking-actions">
                    <form method="GET" action="/dashboard/user/bookings">
                        <input type="hidden" name="booking_id" value="<?= $upcomingBooking['id'] ?>">
                        <button type="submit" class="user-btn amend">Amend</button>
                    </form>
                    <form method="POST" action="/dashboard/user/bookings/cancel" style="display:inline;" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                        <input type="hidden" name="booking_id" value="<?= $upcomingBooking['id'] ?>">
                        <button type="submit" class="user-btn cancel">Cancel</button>
                    </form>
                </td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="6" class="no-booking-message">No upcoming bookings at the moment.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Amend Booking Section -->
<?php if (isset($bookingDetails)): ?>
    <h3>Amend Your Booking</h3>
    <form action="/dashboard/user/bookings/amend" method="POST">
        <input type="hidden" name="booking_id" value="<?= $bookingDetails['id'] ?>">

        <label for="barber">Choose a Barber:</label>
        <select name="barber_id" id="barber" required>
            <option value="">Select a Barber</option>
            <?php foreach ($barbers as $barber): ?>
                <option value="<?= htmlspecialchars($barber['id']) ?>"
                    <?= $barber['id'] == $bookingDetails['barber_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($barber['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="date">Preferred Date:</label>
        <input type="date" name="date" id="preferred-date" required
            value="<?= htmlspecialchars($bookingDetails['booking_date']) ?>">

        <label>Preferred Time:</label>
        <div id="time-slot-container" class="time-slots" style="display: flex; flex-wrap: wrap; gap: 5px;">
            <!-- Time slots go here -->
        </div>

        <br>
        <button type="submit">Save Changes</button>
    </form>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/userLayout.php';
?>
