const toggleContrast = document.querySelectorAll('.js-toggle-contrast');
const currentContrast = localStorage.getItem('contrast');

function setStoredContrastAttributes() {
    const selectedContrast = document.querySelector(`[data-contrast=${currentContrast}]`);

    document.documentElement.setAttribute('data-theme', currentContrast);
    selectedContrast.checked = true;
}

function switchContrast(e) {
    const contrastValue = e.target.getAttribute('data-contrast');

    document.documentElement.setAttribute('data-theme', contrastValue);
    localStorage.setItem('contrast', contrastValue);

    e.target.checked = true;
}

if (toggleContrast) {
    if (currentContrast != null) {
        setStoredContrastAttributes();
    }

    toggleContrast.forEach((toggle) => toggle.addEventListener('click', switchContrast));
}
