<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        let container = document.getElementById('js-cookie-settings-container');
        let settingsButton = document.getElementById('js-cookie-settings-button');

        if(settingsButton) {
            settingsButton.addEventListener('click', () => {
                container.style.display = container.style.display === 'none' ? 'flex' : 'none';

                if(settingsButton.getAttribute('aria-expanded') === 'true') {
                    settingsButton.setAttribute('aria-expanded', false);
                } else {
                    settingsButton.setAttribute('aria-expanded', true);
                }
            });
        }

        const checkboxes = document.querySelectorAll('#cc-settings-form .js-cookie-setting-button.js-cookie-toggleable');

        for (let i = 0; i < checkboxes.length; i++) {
            let button = checkboxes[i];

            button.addEventListener('click', (event) => {
                let input = button.querySelector('.js-cookie-setting-button-input');

                button.classList.toggle('cc-setting-selected');

                input.checked = button.classList.contains('cc-setting-selected');
            });
        }
    })

    function selectAll(event) {
        document.querySelectorAll('#cc-settings-form input[type="checkbox"]').forEach(function (input) {
            input.checked = true;
        })
    }
</script>
