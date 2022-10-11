<script lang="ts">
    import Navbar from "../../Components/Hub/Navbar.svelte";
</script>

<main>
    <Navbar />
    <article class="m-10">
        <slot />
    </article>
</main>
