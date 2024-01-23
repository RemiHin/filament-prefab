const toggleAccessibilityModal = document.querySelectorAll('.js-toggle-wcag-modal');
const menuButtonAccessibility = document.querySelector('.js-wcag-menu-button');
const accessibilityModal = document.querySelector('.js-wcag-modal');

function resetFocusAccessibility() {
    menuButtonAccessibility.focus();
}

function closeModalOnEscape() {
    document.addEventListener('keydown', (event) => {
        if (event.keyCode === 27) {
            menuButtonAccessibility.setAttribute('aria-expanded', 'false');
            menuButtonAccessibility.classList.remove('is-active');

            accessibilityModal.classList.remove('is-active');
            accessibilityModal.setAttribute('aria-modal', 'false');

            resetFocusAccessibility();
        }
    });
}

function loopWithinModal(m) {
    m.querySelectorAll('.js-loop-tab-wcag-modal').forEach((item) => {
        item.addEventListener('focus', () => {
            m.querySelector('.js-close-wcag-modal').focus();
        });
    }, false);
}

function toggleModal() {
    menuButtonAccessibility.classList.toggle('is-active');

    if (menuButtonAccessibility.classList.contains('is-active')) {
        menuButtonAccessibility.setAttribute('aria-expanded', 'true');

        accessibilityModal.classList.add('is-active');
        accessibilityModal.querySelector('.js-close-wcag-modal').focus();
        accessibilityModal.setAttribute('aria-modal', 'true');

        loopWithinModal(accessibilityModal);
        closeModalOnEscape();
    } else {
        menuButtonAccessibility.setAttribute('aria-expanded', 'false');

        accessibilityModal.classList.remove('is-active');
        accessibilityModal.setAttribute('aria-modal', 'false');

        resetFocusAccessibility();
    }
}

if (toggleAccessibilityModal) {
    toggleAccessibilityModal.forEach((toggle) => toggle.addEventListener('click', toggleModal));
}
