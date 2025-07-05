// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcssVitePlugin from "@tailwindcss/vite"; // PASTIKAN INI DIIMPORT

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css", // Pastikan jalur ini benar ke file CSS utama Anda
                "resources/js/app.js", // Pastikan jalur ini benar ke file JS utama Anda
            ],
            refresh: true,
        }),
        tailwindcssVitePlugin(), // PASTIKAN PLUGIN INI DITAMBAHKAN
    ],
});
