import '../css/app.css';
import { createInertiaApp } from '@inertiajs/inertia-svelte'

/**
 * Imports the given page component from the page record.
 */
function resolvePageComponent(name: string, pages: Record<string, any>) {
  for (const path in pages) {
    if (path.endsWith(`${name.replace('.', '/')}.svelte`)) {
      return typeof pages[path] === 'function'
        ? pages[path]()
        : pages[path]
    }
  }

  throw new Error(`Page not found: ${name}`)
}

createInertiaApp({
  resolve: name => resolvePageComponent(name, import.meta.glob('../js/Pages/**/*.svelte')),
  setup({ el, App, props }) {
    new App({ target: el, props })
  },
})
