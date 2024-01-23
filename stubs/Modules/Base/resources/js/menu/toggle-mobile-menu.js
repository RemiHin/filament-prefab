const toggleMobileMenu = document.querySelectorAll('.js-toggle-mobile-menu');
const mobileMenuButton = document.querySelector('.js-mobile-menu-button');
const mobileMenu = document.querySelector('.js-mobile-menu');

function resetFocusMenu() {
    mobileMenuButton.focus();
}

function closeMobileMenuOnEscape() {
    document.addEventListener('keydown', (event) => {
        if (event.keyCode === 27) {
            mobileMenuButton.classList.remove('is-active');
            mobileMenuButton.setAttribute('aria-expanded', 'false');

            mobileMenu.classList.remove('is-active');
            mobileMenu.setAttribute('aria-modal', 'false');

            resetFocusMenu();
        }
    });
}

function loopWithinMenu(i) {
    i.querySelectorAll('.js-loop-mobile-menu').forEach((item) => {
        item.addEventListener('focus', () => {
            i.querySelector('.js-close-mobile-menu').focus();
        });
    }, false);
}

function toggleMenu() {
    mobileMenuButton.classList.toggle('is-active');
    mobileMenu.classList.toggle('is-active');

    if (mobileMenuButton.classList.contains('is-active')) {
        mobileMenuButton.setAttribute('aria-expanded', 'true');
        mobileMenu.setAttribute('aria-modal', 'true');
        mobileMenu.querySelector('.js-close-mobile-menu').focus();

        loopWithinMenu(mobileMenu);
        closeMobileMenuOnEscape();
    } else {
        mobileMenuButton.setAttribute('aria-expanded', 'false');
        mobileMenu.setAttribute('aria-modal', 'false');

        resetFocusMenu();
    }
}

if (toggleMobileMenu) {
    toggleMobileMenu.forEach((toggle) => toggle.addEventListener('click', toggleMenu));
}
