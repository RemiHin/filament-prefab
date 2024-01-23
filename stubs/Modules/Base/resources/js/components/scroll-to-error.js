document.querySelectorAll('[data-scroll-to]').forEach((element) => {
    element.addEventListener('click', (event) => {
        event.preventDefault();

        let source = event.target;
        let from = null;
        let until = null;
        let offset = 100;

        if (!source.hasAttribute('data-scroll-to')) {
            source = source.closest('[data-scroll-to]');
        }

        const selector = source.dataset.scrollTo;
        const target = document.querySelector(selector);

        if (source.hasAttribute('data-scroll-to-offset')) {
            offset = source.dataset.scrollToOffset;
        }

        if (source.hasAttribute('data-scroll-to-from')) {
            from = source.dataset.scrollToFrom;
        }

        if (source.hasAttribute('data-scroll-to-until')) {
            until = source.dataset.scrollToUntil;
        }

        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        if (from && window.screen.width < from) {
            return;
        }

        if (until && window.screen.width > until) {
            return;
        }

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth',
        });

        target.focus();
    });
});
