<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
</script>

<main>
    <header>
        <Link href="/">Home</Link>
        {#if $page.props.user }
            <Link href="/hub">Hub</Link>
        {:else}
            <a href="/auth/redirect">Login</a>
        {/if}
        <Link href="/contact">Contact</Link>
    </header>
    <article>
        <slot />
    </article>
</main>
