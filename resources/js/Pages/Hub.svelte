<script lang="ts">
    import Layout from './Layout.svelte'
    export let missions;
</script>
  
<Layout>
    <h1>Hub</h1>

    {#each missions as mission}
        <li>{mission.display_name}</li>
    {/each}
</Layout>
