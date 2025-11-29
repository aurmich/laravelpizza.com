import {
    defineConfig
} from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'Themes/Meetup/resources/html/css/app.css',
                'Themes/Meetup/resources/html/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        host: '0.0.0.0',
    },
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: {
                'app': 'resources/js/app.js',
                'meetup-css': 'Themes/Meetup/resources/html/css/app.css',
                'meetup-js': 'Themes/Meetup/resources/html/js/app.js',
            },
        },
    },
});