<script lang="ts">
    import Card from "./Card.svelte";
    import MissionUploadCard from "./MissionUploadCard.svelte";

    export let missions;
    export let title = "";
    export let uploadCard = false;
    export let open = true;
    export let shouldRedirect;
</script>

<div class="grid grid-cols-1 gap-3 pt-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
    {#if title != ""}
        <button on:click={(e) => (open = !open)} class="flex justify-center text-blue-600">
            <h3 class="my-2 text-center text-xl font-bold uppercase leading-tight">{title}</h3>
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2.5"
                stroke="currentColor"
                class="ml-1 mt-2.5 h-6 w-6"
            >
                {#if open}
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                {:else}
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                {/if}
            </svg>
        </button>
    {/if}
    <div
        class="{open
            ? ''
            : 'hidden'} col-span-full grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6"
    >
        {#if uploadCard}
            <MissionUploadCard />
        {/if}
        {#each missions as mission}
            <Card {shouldRedirect} {mission} on:cardClicked />
        {/each}
    </div>
</div>
