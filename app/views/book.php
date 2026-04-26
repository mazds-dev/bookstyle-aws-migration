<?php

// Ensure the service variable exists DEBUG
if (!isset($service) || !$service) {
    error_log("Service not found or invalid service ID.");
    header("Location: /404");  // Redirect to a 404 page
    exit;
}

?>

<script src="https://js.stripe.com/v3/"></script>

<!-- Booking Form Section -->
<section id="book">
    <h2>Book an Appointment</h2>
    
    <!-- Information about the selected service -->
    <div class="book-form">
        <p>You're booking: <strong><?= htmlspecialchars($service['name']); ?></strong>
            Duration: <?= htmlspecialchars($service['duration']); ?> min. 
                Price: € <?= htmlspecialchars($service['price']); ?>
        </p>

        <form action="add_booking_details" method="POST">
            <input type="hidden" name="service_id" value="<?= htmlspecialchars($service['id']); ?>">
            <input type="hidden" name="service_name" value="<?= htmlspecialchars($service['name']); ?>">
            <input type="hidden" name="service_price" value="<?= htmlspecialchars($service['price']); ?>">
            <input type="hidden" name="barber_id" value="<?= $barberId ?>">


            <label for="barber">Choose a Barber:</label>
            <select name="barber_id" id="barber" required>
                <option value="">Select a Barber</option>
                <?php foreach ($barbers as $barber): ?>
                    <option value="<?= htmlspecialchars($barber['id']) ?>">
                        <?= htmlspecialchars($barber['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="date">Preferred Date:</label>
            <input type="date" name="date" id="preferred-date" required>

            <label>Preferred Time:</label>
            <div id="time-slot-container" class="time-slots" style="display: flex; flex-wrap: wrap; gap: 5px;">
                <p>Please select a date first to see available time slots.</p>
            </div>

            <br>
            <button type="submit">Proceed to Checkout</button>
        </form>
    </div>
    <br>
    <hr>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('preferred-date');
    const barberSelect = document.getElementById('barber');

    if (!dateInput || !barberSelect) return;

    const today = new Date().toISOString().split('T')[0];
    dateInput.setAttribute('min', today);

    // On barber change, re-trigger date logic if date is already selected
    barberSelect.addEventListener('change', function () {
        if (dateInput.value) {
            dateInput.dispatchEvent(new Event('change'));
        }
    });

    // On date change, fetch time slots
    dateInput.addEventListener('change', function () {
        const date = this.value;
        const barberId = barberSelect.value;
        if (!date || !barberId) return;

        fetch(`/api/booked_times?barber_id=${barberId}&date=${date}`)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(bookedTimes => {
                const container = document.getElementById('time-slot-container');
                container.innerHTML = '';

                const start = new Date('1970-01-01T09:00:00');
                const end = new Date('1970-01-01T18:00:00');

                while (start < end) {
                    const timeStr = start.toTimeString().substring(0, 5);
                    const isBooked = Array.isArray(bookedTimes) && bookedTimes.some(t =>
                        (typeof t === 'object' ? t.booking_time : t) === timeStr
                    );

                    const label = document.createElement('label');
                    label.style = "flex: 1 0 70px;";
                    if (isBooked) {
                        label.classList.add('booked');
                        label.style.opacity = "0.5";
                    }

                    const radio = document.createElement('input');
                    radio.type = 'radio';
                    radio.name = 'time';
                    radio.value = timeStr;
                    radio.required = true;
                    radio.disabled = isBooked;

                    label.appendChild(radio);
                    label.appendChild(document.createTextNode(timeStr));
                    container.appendChild(label);

                    start.setMinutes(start.getMinutes() + 30);
                }
            })
            .catch(err => {
                console.error("Error fetching booked times:", err);
                document.getElementById('time-slot-container').innerHTML =
                    '<p class="error">Error loading available times. Please try again.</p>';
            });
    });
}); // <-- This was missing!
</script>
