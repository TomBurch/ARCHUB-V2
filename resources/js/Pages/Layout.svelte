<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    import Navbar from '../Components/Navbar.svelte'
</script>

<main>
    <Navbar/>
    <article>
        <slot />
    </article>
</main>
