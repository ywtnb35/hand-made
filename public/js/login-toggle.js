document.addEventListener('DOMContentLoaded', function () {
    const toggle = document.querySelector('.login-toggle');
    const dropdown = document.querySelector('.login-dropdown');

    if (toggle && dropdown) {
        toggle.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', function () {
            dropdown.style.display = 'none';
        });
    }
});
