const toggleFontsize = document.querySelectorAll('.js-toggle-fontsize');
const currentFontsize = localStorage.getItem('fontsize');

function setStoredFontsizeAttributes() {
    const selectedFontsize = document.querySelector(`[data-fontsize=${currentFontsize}]`);

    document.documentElement.classList.add(`fontsize-${currentFontsize}`);
    selectedFontsize.checked = true;
}

function switchFontsize(e) {
    const sizeFontValue = e.target.getAttribute('data-fontsize');

    document.documentElement.classList.remove(...document.documentElement.classList);
    document.documentElement.classList.add(`fontsize-${sizeFontValue}`);
    localStorage.setItem('fontsize', sizeFontValue);

    e.target.checked = true;
}

if (toggleFontsize) {
    if (currentFontsize != null) {
        setStoredFontsizeAttributes();
    }

    toggleFontsize.forEach((toggle) => toggle.addEventListener('click', switchFontsize));
}
