import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue';
import path from "path";
import inject from '@rollup/plugin-inject';

// https://vitejs.dev/config/
export default defineConfig({
    plugins: [
        vue(),
        inject({
            $: 'jquery',
        }),
    ],
    resolve: {
        alias: {
            "@": path.resolve(__dirname, "./src"),
        },
    },
})