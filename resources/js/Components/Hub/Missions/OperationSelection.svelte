<script lang="ts">
    import { createEventDispatcher } from "svelte";
    import Card from "./Card.svelte";

    export let next_operation;
    export let open = true;
    export let selecting;

    const dispatch = createEventDispatcher();

    $: next_op_missions = { 1: null, 2: null, 3: null };
    $: next_operation.missions.forEach((op_mission) => {
        next_op_missions[op_mission.play_order] = op_mission.mission;
    });

    function handleClick(play_order) {
        selecting = selecting == play_order ? null : play_order;
        dispatch("selecting", {});
    }
</script>

<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
    <button on:click={() => (open = !open)} class="flex justify-center text-blue-600">
        <h3 class="my-2 text-center text-xl font-bold uppercase leading-tight">Next operation</h3>
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
    <div
        class="{open
            ? ''
            : 'hidden'} col-span-full grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6"
    >
        {#each Object.entries(next_op_missions) as [play_order, mission]}
            <div
                class="flex rounded-lg border-4 border-dashed {selecting == play_order
                    ? 'border-rose-400'
                    : 'border-gray-400'}"
            >
                {#if mission}
                    <Card {mission} shouldRedirect={false} on:cardClicked={() => handleClick(play_order)} />
                {:else}
                    <div
                        on:click={() => handleClick(play_order)}
                        class="h-60 min-w-0 flex-grow space-y-1 rounded-lg bg-gray-800 p-3 shadow-md hover:bg-gray-700"
                    />
                {/if}
            </div>
        {/each}
    </div>
</div>
