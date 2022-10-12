import { defineConfig } from "vite";

import { svelte } from "@sveltejs/vite-plugin-svelte";

export default defineConfig(({ command }) => {
    return {
        build: {
            outDir: "public/build",
            manifest: true,
            rollupOptions: {
                input: ["resources/scripts/main.ts"],
            },
        },
        plugins: [
            svelte({
                experimental: {
                    prebundleSvelteLibraries: true,
                },
            })
        ],
    };
});
