<script lang="ts">
    import Card from "../Card.svelte";
    import MissionUploadCard from "../MissionUploadCard.svelte";

    export let title;
    export let missions;
    export let uploadCard = false;
</script>

<h3 class="my-2 text-center text-xl font-bold uppercase leading-tight text-blue-600">{title}</h3>
<div
    class="col-span-full grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6"
>
    {#if uploadCard}
        <MissionUploadCard />
    {/if}
    {#each missions as mission}
        <Card {mission} />
    {/each}
</div>
