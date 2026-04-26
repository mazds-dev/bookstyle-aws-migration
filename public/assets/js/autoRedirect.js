// ===== Auto Redirect Logic (used on success/error pages) =====
document.addEventListener('DOMContentLoaded', function () {
    const redirectElement = document.querySelector('[data-redirect-after][data-redirect-url]');
    if (redirectElement) {
        const seconds = parseInt(redirectElement.getAttribute('data-redirect-after'), 10);
        const url = redirectElement.getAttribute('data-redirect-url');

        if (!isNaN(seconds) && url) {
            setTimeout(function () {
                window.location.href = url;
            }, seconds * 1000);
        }
    }
});






