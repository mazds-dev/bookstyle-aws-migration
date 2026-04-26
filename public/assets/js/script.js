// Smooth Scrolling for anchor links
function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({ behavior: "smooth" });
}

// Fade-out alert messages
document.addEventListener("DOMContentLoaded", () => {
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(() => {
            alert.classList.add('fade-out');
            setTimeout(() => alert.remove(), 1000);
        }, 3000);
    }
});

// Basic Form Validation
document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function(event) {
        const requiredFields = form.querySelectorAll('[required]');
        let valid = true;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                valid = false;
                field.classList.add('error');
            } else {
                field.classList.remove('error');
            }
        });

        if (!valid) {
            event.preventDefault();
            alert("Please fill in all required fields.");
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Select all the add-to-cart forms
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');

    addToCartForms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            // Prevent the page from refreshing and jumping to the top
            event.preventDefault();

            // You can then use an AJAX request here to add to cart (if needed)
            // For now, just submit the form normally without the page jumping
            form.submit();
        });
    });
});



// Mobile Navigation Toggle (for responsive design)
document.querySelector('#nav-toggle').addEventListener('click', function() {
    const nav = document.querySelector('.mobile-nav');
    nav.classList.toggle('visible');
});

// Scroll to Top Button 
const scrollToTopBtn = document.querySelector('#scrollToTop');

window.addEventListener('scroll', function() {
    if (window.scrollY > 300) {
        scrollToTopBtn.style.display = 'block';
    } else {
        scrollToTopBtn.style.display = 'none';
    }
});

scrollToTopBtn.addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
