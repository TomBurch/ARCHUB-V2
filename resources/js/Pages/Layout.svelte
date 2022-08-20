<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
</script>

<main>
    <header>
        {#if $page.props.user}
            <Link href="/hub">Hub</Link>
        {:else}
            <Link href="/login">Login</Link>
        {/if}
        <Link href="/">Home</Link>
        <Link href="/contact">Contact</Link>
    </header>
    <article>
        <slot />
    </article>
</main>
