<script lang="ts">
    import { createEventDispatcher } from "svelte";
    import Card from "./Card.svelte";

    export let title;
    export let operation;
    export let open = true;
    export let selecting;
    let locked = true;

    const dispatch = createEventDispatcher();

    $: op_missions = { 1: null, 2: null, 3: null };
    $: operation.missions.forEach((op_mission) => {
        op_missions[op_mission.play_order] = op_mission.mission;
    });

    function handleClick(play_order) {
        if (selecting && selecting.play_order == play_order && selecting.operation_id == operation.id) {
            selecting = null;
        } else {
            selecting = {
                play_order: play_order,
                operation_id: operation.id,
            };
        }
        dispatch("selecting", {});
    }
</script>

<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-3">
    <div class="flex justify-center">
        <h3 class="my-2 text-center text-xl font-bold uppercase leading-tight text-blue-600">{title}</h3>
        <button on:click={() => (locked = !locked)} class="pl-1 text-blue-600">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2.5"
                stroke="currentColor"
                class="h-5 w-5"
            >
                {#if locked}
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                    />
                {:else}
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                    />
                {/if}
            </svg>
        </button>
    </div>
    <div
        class="{open
            ? ''
            : 'hidden'} col-span-full grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-3"
    >
        {#each Object.entries(op_missions) as [play_order, mission]}
            <div
                class="flex {locked ? '' : 'rounded-lg border-4 border-dashed'} {selecting &&
                selecting.play_order == play_order &&
                selecting.operation_id == operation.id
                    ? 'border-rose-400'
                    : 'border-gray-400'}"
            >
                {#if mission}
                    <Card {mission} shouldRedirect={locked} on:cardClicked={() => handleClick(play_order)} />
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
