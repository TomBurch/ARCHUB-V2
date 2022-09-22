<script lang="ts">
    import Navbar from "../../Components/Hub/Navbar.svelte";
    import { page } from "@inertiajs/inertia-svelte";
</script>

<main>
    <Navbar />
    <article class="m-10">
        <slot />
    </article>
</main>
