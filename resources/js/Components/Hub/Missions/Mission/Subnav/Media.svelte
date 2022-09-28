<script lang="ts">
    import { Inertia } from "@inertiajs/inertia";
    import { page } from "@inertiajs/inertia-svelte";
    import MediaUploadCard from "../MediaUploadCard.svelte";

    export let mission;

    function handleDelete(media_id) {
        Inertia.delete(`/hub/missions/${mission.id}/media/${media_id}`, {
            onBefore: () => confirm("Are you sure?"),
        });
    }
</script>

<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
    {#each Object.entries(mission.media) as [media_id, url]}
        <div href="/hub/missions/{mission.id}" class="h-60 space-y-1 bg-gray-800 p-3 shadow-md hover:bg-gray-700">
            <div
                class="h-full w-full rounded-lg bg-contain bg-center bg-no-repeat"
                style="background-image: url('{url}');"
            >
                {#if mission.user.id == $page.props.auth.user.id}
                    <button class="float-right" on:click={() => handleDelete(media_id)}>
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="white"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="black"
                            class="h-5 w-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                            />
                        </svg>
                    </button>
                {/if}
            </div>
        </div>
    {/each}
    <MediaUploadCard {mission} />
</div>
