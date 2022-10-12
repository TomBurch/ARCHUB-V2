<script lang="ts" context="module">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { Inertia } from "@inertiajs/inertia";
    // import Svelecte from "svelecte";

    import Subnav from "../../../Components/Hub/Missions/Mission/Subnav/Subnav.svelte";
    import Briefings from "../../../Components/Hub/Missions/Mission/Subnav/Briefings.svelte";
    import AARs from "../../../Components/Hub/Missions/Mission/Subnav/AARs.svelte";
    import Orbat from "../../../Components/Hub/Missions/Mission/Subnav/Orbat.svelte";
    import Notes from "../../../Components/Hub/Missions/Mission/Subnav/Notes.svelte";
    import Media from "../../../Components/Hub/Missions/Mission/Subnav/Media.svelte";
    import MissionUpdateButton from "../../../Components/Hub/Missions/Mission/MissionUpdateButton.svelte";
    import MissionVerifyButton from "../../../Components/Hub/Missions/Mission/MissionVerifyButton.svelte";
    import MissionDeleteButton from "../../../Components/Hub/Missions/Mission/MissionDeleteButton.svelte";
    import MissionDeployButton from "../../../Components/Hub/Missions/Mission/MissionDeployButton.svelte";

    export let mission;
    export let can;

    let navigation = [
        { name: "Briefing", component: Briefings, show: true },
        { name: "Orbat", component: Orbat, show: true },
        {
            name: "AARs",
            component: AARs,
            show: Array.isArray(mission.comments),
        },
        { name: "Notes", component: Notes, show: Array.isArray(mission.notes) },
        { name: "Media", component: Media, show: true },
    ];
    let selected = navigation[0];

    let maintainer_select = mission.maintainer;

    function handleChange(event) {
        let new_maintainer = event.detail ? event.detail : { id: null, username: null };

        Inertia.post(`/hub/missions/${mission.id}/maintainer`, {
            new_maintainer: new_maintainer,
        });
    }
</script>

<div class="mx-auto min-h-screen-no-nav border border-gray-700 bg-gray-800 p-3 shadow-md lg:w-4/5">
    <div class="pb-2 text-center text-gray-300">
        <h5 class="truncate text-3xl tracking-tight text-white">
            {mission.display_name}
        </h5>
        <p class="truncate text-sm font-bold">
            By {mission.user.username}
        </p>
        {#if can.set_maintainers}
            <div class="m-auto min-h-0 w-52 pt-2 text-left">
                <!-- <Svelecte
                    placeholder="Maintainer"
                    fetch="/hub/users"
                    labelField={"username"}
                    valueAsObject={true}
                    bind:value={maintainer_select}
                    on:change={handleChange}
                    style="--sv-min-height: 0px"
                /> -->
            </div>
        {:else if mission.maintainer}
            <p class="truncate text-sm font-bold">
                Maintained by {mission.maintainer.username}
            </p>
        {/if}
        <p class="text-break pt-2 text-sm">
            {mission.summary}
        </p>
    </div>
    <div class="flex flex-row-reverse gap-3 pt-1 text-white">
        {#if can.delete_mission}
            <MissionDeleteButton {mission} />
        {/if}
        {#if can.test_mission}
            <MissionUpdateButton {mission} />
            <a href="/hub/missions/{mission.id}/download">
                <svg
                    class="h-7 w-7"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"
                    />
                </svg>
            </a>
        {/if}
        {#if can.verify_missions}
            <MissionDeployButton {mission} />
            <MissionVerifyButton {mission} />
        {/if}
    </div>
    <div class="pt-3">
        <Subnav bind:navigation bind:selected />
        <div class="my-5 lg:mx-20">
            <svelte:component this={selected.component} {mission} />
        </div>
    </div>
</div>

<!-- <style>
    :global(.svelecte-control .indicator-container:last-child svg) {
        height: 12px;
    }
</style> -->
