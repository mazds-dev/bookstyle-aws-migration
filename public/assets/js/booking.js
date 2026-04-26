// ===== Booking Page Logic =====
document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.getElementById('preferred-date');
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);
    }
});

// ===== Cart Page Logic =====
// your cart-specific code here

// ===== Stripe Checkout =====
// stripe logic here