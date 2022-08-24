<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    import Navbar from '../../Components/Hub/Navbar.svelte'
</script>

<main>
    <Navbar/>
    <article class="m-10">
        <slot />
    </article>
</main>
