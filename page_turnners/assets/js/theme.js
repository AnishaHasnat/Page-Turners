document.addEventListener('DOMContentLoaded', function () {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    // Load saved theme or default to light
    const savedTheme = localStorage.getItem('theme') || 'light';
    body.classList.add(`theme-${savedTheme}`);
    updateIcon(savedTheme);
    // Toggle theme on button click
    themeToggle.addEventListener('click', () => {
        const currentTheme = body.classList.contains('theme-dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        body.classList.remove(`theme-${currentTheme}`);
        body.classList.add(`theme-${newTheme}`);
        localStorage.setItem('theme', newTheme);
        updateIcon(newTheme);
    });
    function updateIcon(theme) {
if (theme === 'dark') {
themeToggle.src = 'images/light_mode.png'; // Path to light mode icon
themeToggle.alt = 'Light Mode';
} else {
themeToggle.src = 'images/moon_icon.png'; // Path to dark mode icon
themeToggle.alt = 'Dark Mode';
}
}
});
