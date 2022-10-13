import '../css/tailwind.css';
import { createInertiaApp } from '@inertiajs/inertia-svelte'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
  resolve: (name) => resolvePageComponent(`../views/pages/${name}.svelte`, import.meta.glob('../views/pages/**/*.svelte')),
  setup({ el, App, props }) {
    new App({ target: el, props })
  },
})
