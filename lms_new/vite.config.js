import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";
import path from "path";
import i18nResources from "vite-plugin-i18n-resources";


export default defineConfig({
    plugins: [
        vue(),
        i18nResources({
            path: path.resolve(__dirname, "resources/js/views"),
        }),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "resources/js"),
        },
    },
});
