import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',

                //ADMIN
                'resources/assets/vendor/fonts/iconify/iconify.css',
                'resources/assets/vendor/scss/core.scss',
                'resources/assets/css/demo.css',
                'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.scss',

                'resources/assets/vendor/scss/core.scss',
                'resources/assets/vendor/scss/pages/page-auth.scss',

                'resources/assets/vendor/js/helpers.js',
                'resources/assets/js/config.js',
                'resources/assets/vendor/libs/jquery/jquery.js',
                'resources/assets/vendor/libs/popper/popper.js',
                'resources/assets/vendor/js/bootstrap.js',
                'resources/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
                'resources/assets/vendor/js/menu.js',
                'resources/assets/js/main.js'
            ],
            refresh: true,
        }),

        tailwindcss(),
    ]
});
