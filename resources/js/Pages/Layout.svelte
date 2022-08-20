<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
</script>

<main>
    <header>
        <Link href="/">Home</Link>
        <Link href="/hub">Hub</Link>
        <Link href="/contact">Contact</Link>
    </header>
    <article>
        <slot />
    </article>
</main>
