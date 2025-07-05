import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: true,
        strictPort: true,
        cors: {
          origin: ['https://9388-151-75-128-175.ngrok-free.app'],
          credentials: true,
        },
      },
    
});
