function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({ behavior: "smooth" });
}

function openBooking(service) {
    document.getElementById("selectedService").textContent = "Service: " + service;
    document.getElementById("bookingModal").style.display = "flex";
}

function closeBooking() {
    document.getElementById("bookingModal").style.display = "none";
}

function confirmBooking() {
    const date = document.getElementById("date").value;
    const time = document.getElementById("time").value;
    if (date && time) {
        alert(`Appointment booked for ${date} at ${time}.`);
        closeBooking();
    } else {
        alert("Please select both date and time.");
    }
}

// Block past bookings in the calendar`
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('preferred-date');
    const timeInputs = document.getElementsByName('time');
    
    // Set the minimum date to today
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);

        // Optional: Validate when the date changes
        dateInput.addEventListener('input', function () {
            const selectedDate = new Date(dateInput.value);
            const currentDate = new Date(today);
            if (selectedDate < currentDate) {
                alert('The selected date cannot be in the past.');
                dateInput.setCustomValidity('Invalid date');
            } else {
                dateInput.setCustomValidity(''); // Reset custom validity
            }
        });
    }

    // Validate the form submission (check for time slot selection)
    const form = document.querySelector('form');
    form.addEventListener('submit', function (e) {
        const timeSelected = Array.from(timeInputs).some(input => input.checked);
        if (!timeSelected) {
            e.preventDefault(); // Prevent form submission if no time slot is selected
            alert('Please select a preferred time slot.');
        }
    });
});



// Cart handling
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const product = {
            id: this.dataset.id,
            name: this.dataset.name,
            price: this.dataset.price
        };

        // Add to localStorage cart
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart));

        alert(product.name + " added to cart!");
    });
});




