import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/**/*.blade.php', 'resources/css/filament/admin/theme.css', 'resources/css/cookie-consent.css'],
            refresh: true,
        }),
    ],
});
