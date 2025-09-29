import { defineConfig } from "vite";
import sass from "sass";

export default defineConfig({
  root: "src",
  build: {
    outDir: "../dist",
    emptyOutDir: true,
    rollupOptions: {
        input: {
        main: "src/main.js",
      },
        output: {
        entryFileNames: "main.js",
        assetFileNames: "style.css"
      },
    },
  },
});