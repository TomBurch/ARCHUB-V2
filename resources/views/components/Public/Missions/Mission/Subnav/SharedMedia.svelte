<script lang="ts">
    import { onMount } from "svelte";
    import PhotoSwipeLightbox from "photoswipe/lightbox";
    import "photoswipe/style.css";

    export let mission;

    onMount(() => {
        const lightbox = new PhotoSwipeLightbox({
            gallery: "#gallery",
            children: "#image",
            pswpModule: () => import("photoswipe"),
        });
        lightbox.init();
    });
</script>

<div
    id="gallery"
    class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5"
>
    {#each Object.entries(mission.media) as [media_id, media]}
        <div class="relative h-60 space-y-1 bg-gray-800 p-3 shadow-md hover:bg-gray-700">
            <a
                class="h-full w-full"
                id="image"
                href={media.url}
                data-pswp-width={media.width}
                data-pswp-height={media.height}
                target="_blank"
            >
                <img class="h-full w-full object-contain" src={media.url} alt="" />
            </a>
        </div>
    {/each}
</div>
