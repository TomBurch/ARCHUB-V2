<script lang="ts">
    import Layout from '../Layout.svelte'
    import Card from '../../../Components/Hub/Missions/Card.svelte'
    import MissionUploadCard from '../../../Components/Hub/Missions/MissionUploadCard.svelte';
    
    export let missions;
    export let my_missions;
</script>
  
<Layout>
    <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
        <h3 class="uppercase text-center font-bold leading-tight text-2xl mb-2 text-blue-600">My missions</h3>
        <div class="col-span-full grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
            <MissionUploadCard/>
            {#each my_missions as mission}
                <Card mission={mission}/>
            {/each}
        </div>
        <h3 class="uppercase text-center font-bold leading-tight text-2xl my-2 text-blue-600">All missions</h3>
        <div class="col-span-full grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
            {#each missions as mission}
                <Card mission={mission}/>
            {/each}
        </div>
    </div>
</Layout>
