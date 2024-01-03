import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            // detectTls: 'my-app.test', 

        }),
        react({
            // jsxRuntime: 'classic' // Add this line
            jsxRuntime: 'automatic' // Add this line
        }),
    ],
});
