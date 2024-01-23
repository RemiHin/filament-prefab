import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography';

export default {
    content: [
        'app/**/*.php',
        'resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                default: {
                    background: 'var(--default-background)',
                    color: 'var(--default-color)',
                    accent: 'var(--default-accent)',
                },
                primary: {
                    DEFAULT: 'var(--primary)',
                    light: 'var(--primary-light)',
                    dark: 'var(--primary-dark)',
                },
                secondary: {
                    DEFAULT: 'var(--secondary)',
                    light: 'var(--secondary-light)',
                    dark: 'var(--secondary-dark)',
                },
                tertiary: {
                    DEFAULT: 'var(--tertiary)',
                    light: 'var(--tertiary-light)',
                    dark: 'var(--tertiary-dark)',
                },
                danger: 'var(--danger)',
                warning: 'var(--warning)',
                success: 'var(--success)',
            },
            container: {
                center: true,
            },
            maxWidth: {
                container: '1280px',
                'container-1/2': '640px',
            },
            translate: {
                fullx2: '200%',
            },
        },
        screens: {
            xs: '480px',
            ...defaultTheme.screens,
        },
    },

    variants: {
        extend: {},
    },

    plugins: [
        forms,
        typography
    ],
};
