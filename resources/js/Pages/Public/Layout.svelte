<script lang="ts">
    import { page } from '@inertiajs/inertia-svelte'
    import Navbar from '../../Components/Public/Navbar.svelte'
</script>

<main>
    <Navbar/>
    <article class="m-10">
        <slot />
    </article>
</main>
