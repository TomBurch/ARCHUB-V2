<script lang="ts" context="module">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import Card from "../../../Components/Hub/Missions/Card.svelte";
    import MissionUploadCard from "../../../Components/Hub/Missions/MissionUploadCard.svelte";

    export let missions;
    export let my_missions;

    missions = Object.values(missions);
    my_missions = Object.values(my_missions);
</script>

<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
    <h3 class="mb-2 text-center text-xl font-bold uppercase leading-tight text-blue-600">My missions</h3>
    <div
        class="col-span-full grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6"
    >
        <MissionUploadCard />
        {#each my_missions as mission}
            <Card {mission} />
        {/each}
    </div>
    <h3 class="my-2 text-center text-xl font-bold uppercase leading-tight text-blue-600">All missions</h3>
    <div
        class="col-span-full grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6"
    >
        {#each missions as mission}
            <Card {mission} />
        {/each}
    </div>
</div>
