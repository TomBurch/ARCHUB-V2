<script lang="ts" context="module">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { onMount } from "svelte";
    import { Inertia } from "@inertiajs/inertia";
    import MultiSelect, { type ObjectOption } from "svelte-multiselect";

    import Subnav, { type SubnavItem } from "../../../Components/Hub/Missions/Mission/Subnav/Subnav.svelte";
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

    $: thumbnail_id = mission.thumbnail ? mission.thumbnail.split("/")[2] : null;

    let navigation: SubnavItem[] = [
        { name: "Briefing", content: Briefings, show: true },
        { name: "Orbat", content: Orbat, show: true },
        {
            name: "AARs",
            content: AARs,
            show: Array.isArray(mission.comments),
        },
        { name: "Notes", content: Notes, show: Array.isArray(mission.notes) },
        { name: "Media", content: Media, show: true },
    ];
    let selected = navigation[0];

    let maintainer_select = mission.maintainer
        ? [{ value: mission.maintainer.id, label: mission.maintainer.username }]
        : null;
    let users: ObjectOption[] = [];

    let tag_select: ObjectOption[] = mission.tags
        ? mission.tags.map((mission_tag) => ({ value: mission_tag.tag.id, label: mission_tag.tag.name }))
        : null;
    let tags: ObjectOption[] = [];

    function changeMaintainer(event) {
        let new_maintainer =
            event.detail.type == "add"
                ? { id: event.detail.option.value, username: event.detail.option.label }
                : { id: null, username: null };

        Inertia.post(`/hub/missions/${mission.id}/maintainer`, {
            new_maintainer: new_maintainer,
        });
    }

    function changeTags(event) {
        if (!event.detail) {
            return;
        }

        switch (event.detail.type) {
            case "add":
                Inertia.post(`/hub/missions/${mission.id}/tags`, {
                    tag: event.detail.option.label,
                });
                break;
            case "remove":
                Inertia.delete(`/hub/missions/${mission.id}/tags/${event.detail.option.value}`);
                break;
        }
    }

    onMount(async () => {
        const res1 = await fetch(`/hub/missions/tags`);
        tags = await res1.json();

        const res2 = await fetch(`/hub/users`);
        users = await res2.json();
    });
</script>

<div class="mx-auto min-h-screen-no-nav border border-gray-700 bg-gray-800 p-3 shadow-md lg:w-4/5">
    {#each Object.entries(mission.media) as [media_id, media]}
        {#if media_id == thumbnail_id}
            <div
                class="fixed top-0 left-0 z-[-1] h-screen w-screen bg-cover bg-center bg-no-repeat"
                style="background-image: url('{media.url}');"
            />
        {/if}
    {/each}
    <div class="pb-1">
        {#if can.assign_tags}
            <div class="rounded bg-blue-200 text-xs font-semibold text-blue-800">
                <MultiSelect
                    on:change={changeTags}
                    bind:selected={tag_select}
                    options={tags}
                    placeholder="Select tags"
                    allowUserOptions={can.manage_tags}
                />
            </div>
        {:else}
            {#each mission.tags as mission_tag}
                <span class="mr-2 rounded bg-blue-200 px-2.5 py-0.5 text-xs font-semibold text-blue-800">
                    {mission_tag.tag.name}
                </span>
            {/each}
        {/if}
    </div>
    <div class="pb-2 text-center text-gray-300">
        <h5 class="truncate text-3xl tracking-tight text-white">
            {mission.display_name}
        </h5>
        <p class="truncate text-sm font-bold">
            By {mission.user.username} on {mission.map.display_name}
        </p>
        {#if can.set_maintainers}
            <div class="m-auto w-52 pt-2 text-left text-xs">
                <MultiSelect
                    maxSelect={1}
                    on:change={changeMaintainer}
                    bind:selected={maintainer_select}
                    options={users}
                    placeholder="Maintainer"
                />
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
        {#if can.update_mission}
            <MissionUpdateButton {mission} />
        {/if}
        {#if can.test_mission}
            <a href="/hub/missions/{mission.id}/download" title="Download">
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
        {#if can.deploy_missions}
            <MissionDeployButton {mission} />
        {/if}
        {#if can.verify_missions}
            <MissionVerifyButton {mission} />
        {/if}
    </div>
    <div class="pt-3">
        <Subnav bind:navigation bind:selected />
        <div class="my-5 lg:mx-20">
            <svelte:component this={selected.content} {mission} {can} />
        </div>
    </div>
</div>
