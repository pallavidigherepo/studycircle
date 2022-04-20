import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import path from "path";
import i18nResources from "vite-plugin-i18n-resources";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [
    vue(),
    i18nResources({
      path: path.resolve(__dirname, "src/views"),
    }),
  ],
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "./src"),
    },
  },
});