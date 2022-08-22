<script lang="ts">
    import Layout from './Layout.svelte'
    export let mission;
</script>
  
<Layout>
    <div class="block h-screen p-3 rounded-lg border border-gray-200 shadow-md bg-gray-800 border-gray-700 hover:bg-gray-700">
        <h5 class="pb-2 truncate text-center text-3xl font-bold text-white tracking-tight">{mission.display_name}</h5>
        <p class="truncate text-center text-sm font-normal text-gray-400">By {mission.user.username}</p>
        <p class="truncate text-sm font-normal text-gray-400">{mission.summary}</p>
    </div>
</Layout>
