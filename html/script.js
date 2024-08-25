// Check if the user has a saved theme preference
document.addEventListener('DOMContentLoaded', (event) => {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const userPreferredTheme = localStorage.getItem('theme');

    if (userPreferredTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        darkModeToggle.checked = true;
    }

    darkModeToggle.addEventListener('change', (event) => {
        if (event.target.checked) {
            document.documentElement.setAttribute('data-theme', 'dark');
            localStorage.setItem('theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
            localStorage.setItem('theme', 'light');
        }
    });
});

//Trieed testing this untill an error occured