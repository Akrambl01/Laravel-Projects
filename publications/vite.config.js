import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from 'vite-plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            // refresh: true, // by default, it will refresh the browser on changes in css or js files
            watch: ['resources/views/**'], // to watch these views files or folders
            // refresh: ['resources/views/**'], // to refresh the browser on changes in these views files or folders
        }),
        react(),
    ],
});


// to install react in laravel 
// rus this command 
// 1- install the plugin : npm i react-vite-plugin
// 2- install react : npm i react react-dom
// 3- install react-vite-plugin : npm i vite-plugin-react