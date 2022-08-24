<script lang="ts">
    import Layout from '../Layout.svelte'
    import Card from '../../../Components/Hub/Missions/Card.svelte'
    export let missions;
</script>
  
<Layout>
    <div class="grid gap-3 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
        {#each missions as mission}
            <Card mission={mission}/>
        {/each}
    </div>
</Layout>
