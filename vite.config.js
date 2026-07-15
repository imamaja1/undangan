import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', { weights: [400, 500, 600] }),
                bunny('Great Vibes', { weights: [400] }),
                bunny('Playfair Display', { weights: [400, 600, 700] }),
                bunny('Poppins', { weights: [300, 400, 500, 600] }),
            ],
        }),
        tailwindcss(),
    ],
});
