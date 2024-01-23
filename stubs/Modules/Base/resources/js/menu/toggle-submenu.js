const submenuParents = document.querySelectorAll('.js-toggle-submenu');

function closeSubmenu(l) {
    l.classList.remove('is-active');
    l.nextElementSibling.classList.remove('is-active');
    l.setAttribute('aria-expanded', false);
}

function detectClickAway(j) {
    document.addEventListener('click', (event) => {
        const isClickInsideElement = j.contains(event.target);
        if (!isClickInsideElement) {
            closeSubmenu(j);
        }
    });
}

function closeSubmenuOnEscape(k) {
    document.addEventListener('keydown', (event) => {
        if (event.keyCode === 27) {
            closeSubmenu(k);
        }
    });
}

function submenuToggle(i) {
    i.classList.toggle('is-active');
    i.nextElementSibling.classList.toggle('is-active');

    if (i.classList.contains('is-active')) {
        i.setAttribute('aria-expanded', true);
        closeSubmenuOnEscape(i);
        detectClickAway(i);

        document.addEventListener('focusin', function _tabAway(e) {
            const isTabInsideActiveSubmenu = document.querySelector('.js-submenu.is-active').contains(e.target);
            const isTabParent = document.querySelector('.js-toggle-submenu.is-active').contains(e.target);

            if (!isTabInsideActiveSubmenu && !isTabParent) {
                document.removeEventListener('click', _tabAway, true);
                closeSubmenu(i);
            }
        }, true);
    } else {
        i.setAttribute('aria-expanded', false);
    }
}

submenuParents.forEach((elem) => {
    elem.addEventListener('click', () => {
        submenuToggle(elem);
    });

    elem.addEventListener('keydown', (e) => {
        if (e.keyCode === 13 || e.keyCode === 32) {
            e.preventDefault();
            submenuToggle(elem);
        }
    });
}, false);
