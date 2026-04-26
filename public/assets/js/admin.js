// Sidebar toggle for smaller screens
document.getElementById("sidebar-toggle").addEventListener("click", function() {
    const sidebar = document.querySelector(".admin-sidebar");
    sidebar.classList.toggle("collapsed");  // Toggle the collapsed class for hiding/showing the sidebar
});

// Example: Handling dynamic table updates (such as confirming a booking)
document.querySelectorAll('.confirm-booking-btn').forEach(button => {
    button.addEventListener('click', function() {
        const bookingId = this.dataset.bookingId;
        if (confirm("Are you sure you want to confirm this booking?")) {
            // Use AJAX to update the booking status
            fetch(`/admin/confirm_booking?id=${bookingId}`)
                .then(response => response.json())
                .then(data => {
                    alert(data.message); // Success message
                    window.location.reload(); // Reload the page to reflect the changes
                })
                .catch(err => alert('Error: ' + err));
        }
    });
});
