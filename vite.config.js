import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

// export default defineConfig({

//     plugins: [
//         laravel({
//             input: 'resources/js/app.jsx',
//         }),
//         react(),
//     ],
//     resolve: {
//         alias: {
//             '@': '/resources/js/',
//         },
//     },

// });

export default ({ command }) => ({
    base: command === 'serve' ? '' : '/build/',
    publicDir: 'fake_dir_so_nothing_gets_copied',
    build: {
        manifest: true,
        outDir: 'public/build',
        rollupOptions: {
            input: 'resources/js/app.js',
        },
    },
    plugins: [
        reactRefresh(),
    ],
});
