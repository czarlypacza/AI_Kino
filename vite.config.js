import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'public/js/bootstrap.bundle.js',
                'public/css/bootstrap.css'
            ],
            refresh: true,
        }),
    ],
});
