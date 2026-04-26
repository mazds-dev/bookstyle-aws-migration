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
                    <form method="POST" action="/dashboard/user/bookings/amend" style="display:inline;">
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


<h3>Past Bookings</h3>
<?php if (empty($pastBookings)): ?>
    <p>You have no past bookings.</p>
<?php else: ?>
    <div class="table-scroll-wrapper">
    <table class="styled-table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Barber</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pastBookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['service_name']) ?></td>
                        <td><?= htmlspecialchars($booking['barber_name']) ?></td>
                        <td><?= formatDate($booking['booking_date']) ?></td>
                        <td><?= formatTime($booking['booking_time']) ?></td>
                        <td>
                            <?php
                                $status = strtolower($booking['status']);
                                $bookingDateTime = strtotime($booking['booking_date'] . ' ' . $booking['booking_time']);
                                $now = time();

                                if ($status === 'cancelled') {
                                    echo 'Cancelled ❌';
                                } elseif ($status === 'no-show') {
                                    echo 'No-show 🚫';
                                } elseif ($bookingDateTime < $now) {
                                    echo 'Attended ✅';
                                } else {
                                    echo ucfirst($status);
                                }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/userLayout.php';
?>
