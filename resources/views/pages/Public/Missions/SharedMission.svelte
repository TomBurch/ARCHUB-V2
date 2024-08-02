<script lang="ts">
    import Subnav, { type SubnavItem } from "../../../Components/Hub/Missions/Mission/Subnav/Subnav.svelte";
    import SharedBriefings from "../../../Components/Public/Missions/Mission/Subnav/SharedBriefings.svelte";
    import SharedMedia from "../../../Components/Public/Missions/Mission/Subnav/SharedMedia.svelte";

    export let mission;

    $: thumbnail_id = mission.thumbnail ? mission.thumbnail.split("/")[2] : null;

    let navigation: SubnavItem[] = [
        { name: "Briefing", content: SharedBriefings, show: true },
        { name: "Media", content: SharedMedia, show: true },
    ];
    let selected = navigation[0];
</script>

<div class="m-10">
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
            {#each mission.tags as mission_tag}
                <span class="mr-2 rounded bg-blue-200 px-2.5 py-0.5 text-xs font-semibold text-blue-800">
                    {mission_tag.tag.name}
                </span>
            {/each}
        </div>
        <div class="pb-2 text-center text-gray-300">
            <h5 class="truncate text-3xl tracking-tight text-white">
                {mission.display_name}
            </h5>
            <p class="truncate text-sm font-bold">
                By {mission.user.username} on {mission.map.display_name}
            </p>
            {#if mission.maintainer}
                <p class="truncate text-sm font-bold">
                    Maintained by {mission.maintainer.username}
                </p>
            {/if}
            <p class="text-break pt-2 text-sm">
                {mission.summary}
            </p>
        </div>
        <div class="pt-3">
            <Subnav bind:navigation bind:selected />
            <div class="my-5 lg:mx-20">
                <svelte:component this={selected.content} {mission} />
            </div>
        </div>
    </div>
</div>
