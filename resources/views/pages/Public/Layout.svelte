<script lang="ts">
    import Navbar from "../../Components/Public/Navbar.svelte";
</script>

<main>
    <Navbar />
    <article class="m-10">
        <slot />
    </article>
</main>
