import { defineConfig } from "vite";
import { svelte } from "@sveltejs/vite-plugin-svelte";

export default defineConfig(({ command }) => {
    return {
        // https://sebastiandedeyne.com/vite-with-laravel/
        base: command === "serve" ? "" : "/build/",
        publicDir: "fake_dir_so_files_in_public_arent_copied_into_build",
        build: {
            manifest: true,
            outDir: "public/build",
            rollupOptions: {
                input: ["resources/scripts/main.ts"],
            },
        },
        plugins: [
            svelte({
                experimental: {
                    prebundleSvelteLibraries: true,
                },
            }),
        ],
    };
});
