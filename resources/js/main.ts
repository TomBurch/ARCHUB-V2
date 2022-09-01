import '../css/app.css'; 
import { createInertiaApp } from '@inertiajs/inertia-svelte'
import Layout from './Pages/Hub/Layout.svelte';

export const withVite = (name) => {
  const pages = import.meta.glob("./Pages/**/*.svelte");
  for (const path in pages) {
    if (path.endsWith(`${name.replace(".", "/")}.svelte`)) {
      return typeof pages[path] === "function" ? pages[path]() : pages[path];
    }
  }

  throw new Error(`Page not found: ${name}`);
};

createInertiaApp({
  resolve: (name) => {
    return withVite(name);
  },
  setup({ el, App, props }) {
    new App({ target: el, props });
  },
});
