<script lang="ts" context="module">
    import Layout from '../Layout.svelte'
    export const layout = Layout
</script>

<script lang="ts">
    import PageSelect from '../../../Components/Hub/Missions/PageSelect.svelte'
    import Briefing from '../../../Components/Hub/Missions/Subnav/Briefing.svelte';
    import Overview from '../../../Components/Hub/Missions/Subnav/Overview.svelte';

    export let mission;

    let navigation = [
        { name: 'Overview', component: Overview},
        { name: 'Briefing', component: Briefing},
    ]
    let selected = navigation[0];
</script>
  
<div class="h-screen-no-nav lg:w-4/5 mx-auto p-3 border border-gray-200 shadow-md bg-gray-800 border-gray-700">
    <h5 class="truncate text-center text-3xl font-bold text-white tracking-tight">{mission.display_name}</h5>
    <p class="truncate text-center text-sm font-bold text-gray-300">By {mission.user.username}</p>
    <p class="pt-2 truncate text-center text-sm font-normal text-gray-300">{mission.summary}</p>

    <div class="pt-5">
        <PageSelect bind:navigation bind:selected/>
        <svelte:component this={selected.component}/>
    </div>
</div>
