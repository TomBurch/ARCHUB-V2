<script lang="ts" context="module">
    import Layout from '../Layout.svelte'
    export const layout = Layout
</script>

<script lang="ts">
    import Subnav from '../../../Components/Hub/Missions/Subnav/Subnav.svelte'
    import Briefings from '../../../Components/Hub/Missions/Subnav/Briefings.svelte';
    import AARs from '../../../Components/Hub/Missions/Subnav/AARs.svelte';
    import Notes from '../../../Components/Hub/Missions/Subnav/Notes.svelte';
    import Media from '../../../Components/Hub/Missions/Subnav/Media.svelte';

    export let mission;

    let navigation = [
        { name: 'Briefing', component: Briefings, show: true},
        { name: 'AARs', component: AARs, show: Array.isArray(mission.comments)},
        { name: 'Notes', component: Notes, show: Array.isArray(mission.notes)},
        { name: 'Media', component: Media, show: true},
    ]
    let selected = navigation[0];
</script>
  
<div class="min-h-screen-no-nav lg:w-4/5 mx-auto p-3 shadow-md border border-gray-700 bg-gray-800">
    <h5 class="truncate text-center text-3xl font-bold text-white tracking-tight">{mission.display_name}</h5>
    <p class="truncate text-center text-sm font-bold text-gray-300">By {mission.user.username}</p>
    <p class="pt-2 truncate text-center text-sm font-normal text-gray-300">{mission.summary}</p>

    <div class="pt-5">
        <Subnav bind:navigation bind:selected/>
        <div class="my-5 mx-20">
            <svelte:component this={selected.component} mission={mission}/>
        </div>
    </div>
</div>
