import { fileURLToPath, URL } from "node:url";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
//import i18nResources from "vite-plugin-i18n-resources";
import { resolve } from "path";

// https://vitejs.dev/config/
export default defineConfig({
  build: {
    commonjsOptions: {
      include: ["tailwind.config.js", "node_modules/**"],
    },
  },
  optimizeDeps: {
    include: ["tailwind-config"],
  },
  plugins: [
    vue(),
    // i18nResources({
    //   path: resolve(__dirname, "src/locales"),
    // }),
  ],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url)),
      "tailwind-config": fileURLToPath(
        new URL("./tailwind.config.js", import.meta.url)
      ),
    },
  },
});
