<script lang="ts">
    import MediaUploadCard from "../MediaUploadCard.svelte";

    export let mission;
</script>

<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
    {#each mission.media as media}
        <img src={media} alt="thumb" />
    {/each}
    <MediaUploadCard {mission} />
</div>
