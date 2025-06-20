document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.querySelector('.sidebar-toggle-btn');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    const body = document.body;

    if (toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            body.classList.toggle('sidebar-open');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            body.classList.remove('sidebar-open');
        });
    }
});
