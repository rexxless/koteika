import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    server: {
        hmr: {
            port: 3000,
            host: 'localhost'
        },
        port: 3000,
        host: "localhost",
        allowedHosts: 'all',
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
            detectTls: false,
        }),
        vue(),
    ],
});
