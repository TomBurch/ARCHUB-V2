<script lang="ts">
    import { onMount } from "svelte"
    import { Inertia } from "@inertiajs/inertia";
    import PhotoSwipeLightbox from 'photoswipe/lightbox';
    import 'photoswipe/style.css';
    import Card from "../../Card.svelte";
    import MediaUploadCard from "../MediaUploadCard.svelte";

    export let mission;
    export let can;
    
    $: thumbnail_id = mission.thumbnail ? mission.thumbnail.split("/")[2] : null;

    function handleDelete(media_id) {
        Inertia.delete(`/hub/missions/${mission.id}/media/${media_id}`, {
            onBefore: () => confirm("Are you sure?"),
        });
    }

    function changeThumbnail(media_id) {
        if (media_id == thumbnail_id) {
            return;
        }

        Inertia.post(`/hub/missions/${mission.id}/thumbnail/${media_id}`);
    }

    onMount(() => {
        const lightbox = new PhotoSwipeLightbox({
            gallery: '#gallery',
            children: '#image',
            pswpModule: () => import('photoswipe')
        });
        lightbox.init();
    });
</script>

<div id="gallery" class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5">
    {#if can.manage_media}
        <Card {mission} shouldRedirect={false} />
    {/if}
    {#each Object.entries(mission.media) as [media_id, media]}
        <div class="relative h-60 space-y-1 bg-gray-800 p-3 shadow-md hover:bg-gray-700">
            <button class="absolute top-1 right-0 z-10" on:click={() => handleDelete(media_id)}>
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
            <button class="absolute top-0 left-0 z-10" on:click={() => changeThumbnail(media_id)}>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill={media_id == thumbnail_id ? "yellow" : "white"}
                    stroke-width="1.5"
                    stroke="black"
                    class="h-5 w-5"
                >
                    <path
                        fill-rule="evenodd"
                        d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
            <a class="w-full h-full"
                id="image"    
                href={media.url} 
                data-pswp-width="{media.width}" 
                data-pswp-height="{media.height}" 
                target="_blank">
                <img class="h-full w-full object-contain" src={media.url} alt="" />
            </a>
        </div>
    {/each}
    {#if can.manage_media}
        <MediaUploadCard {mission} />
    {/if}
</div>
