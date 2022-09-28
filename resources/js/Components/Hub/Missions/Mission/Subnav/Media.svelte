<script lang="ts">
    import MediaUploadCard from "../MediaUploadCard.svelte";

    export let mission;
</script>

<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
    {#each mission.media as media}
        <div href="/hub/missions/{mission.id}" class="h-60 space-y-1 bg-gray-800 p-3 shadow-md hover:bg-gray-700">
            <div
                class="h-full w-full rounded-lg bg-contain bg-center bg-no-repeat"
                style="background-image: url('{media}');"
            />
        </div>
    {/each}
    <MediaUploadCard {mission} />
</div>
