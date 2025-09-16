import { defineConfig } from "vite";
import path from "path";
import fullReload from 'vite-plugin-full-reload';

export default defineConfig({
  plugins: [
    fullReload([
      "./templates/**/*.html", // relative path to your theme files
    ]),
  ],
  root: path.resolve(__dirname, "src"),
  build: {
    outDir: path.resolve(__dirname, "dist"),
    manifest: true,
    rollupOptions: {
      input: path.resolve(__dirname, "src/js/main.js"),
    },
  },
  server: {
    host: "vega.test",
    origin: "http://localhost:5173",
    port: 5173,
    cors: {
      origin: "http://vega.test",
      credentials: true,
    },
    hmr: {
      host: "localhost",
      protocol: "ws",
    },
  },
});
