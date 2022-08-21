<script lang="ts">
    import Layout from './Layout.svelte'
    import Card from '../Components/Missions/Card.svelte'
    export let missions;
</script>
  
<Layout>
    <h1>Hub</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
        {#each missions as mission}
            <Card mission={mission}/>
        {/each}
    </div>
</Layout>
