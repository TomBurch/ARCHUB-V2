<script lang="ts" context="module">
    import Layout from '../Layout.svelte'
    export const layout = Layout
</script>

<script lang="ts">
    import Subnav from '../../../Components/Hub/Missions/Subnav/Subnav.svelte'
    import Briefing from '../../../Components/Hub/Missions/Subnav/Briefing.svelte';
    import Orbat from '../../../Components/Hub/Missions/Subnav/Orbat.svelte';
    import AARs from '../../../Components/Hub/Missions/Subnav/AARs.svelte';
    import Notes from '../../../Components/Hub/Missions/Subnav/Notes.svelte';
    import Media from '../../../Components/Hub/Missions/Subnav/Media.svelte';

    export let mission;

    let navigation = [
        { name: 'Briefing', component: Briefing},
        { name: 'Orbat', component: Orbat},
        { name: 'AARs', component: AARs},
        { name: 'Notes', component: Notes},
        { name: 'Media', component: Media},
    ]
    let selected = navigation[0];
</script>
  
<div class="h-screen-no-nav lg:w-4/5 mx-auto p-3 border border-gray-200 shadow-md bg-gray-800 border-gray-700">
    <h5 class="truncate text-center text-3xl font-bold text-white tracking-tight">{mission.display_name}</h5>
    <p class="truncate text-center text-sm font-bold text-gray-300">By {mission.user.username}</p>
    <p class="pt-2 truncate text-center text-sm font-normal text-gray-300">{mission.summary}</p>

    <div class="pt-5">
        <Subnav bind:navigation bind:selected/>
        <div class="mt-5">
            <svelte:component this={selected.component}/>
        </div>
    </div>
</div>
