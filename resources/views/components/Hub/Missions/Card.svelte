<script lang="ts">
    import { createEventDispatcher } from "svelte";
    import { Inertia } from "@inertiajs/inertia";
    import clb from "clb";
    import Lazy from "svelte-lazy";

    export let mission;
    export let shouldRedirect = true;
    let placeholder = "/images/arcomm-placeholder.jpg";

    const dispatch = createEventDispatcher();

    const cardColours = clb({
        base: "",
        compoundVariants: [
            { mode: "coop", type: "border", classes: "border-b-sky-500" },
            { mode: "tvt", type: "border", classes: "border-b-rose-500" },
            { mode: "ade", type: "border", classes: "border-b-emerald-500" },

            { mode: "coop", type: "header", classes: "text-sky-500" },
            { mode: "tvt", type: "header", classes: "text-rose-500" },
            { mode: "ade", type: "header", classes: "text-emerald-500" },
        ],
    });

    function handleClick(event) {
        if (!shouldRedirect) {
            event.preventDefault();
            dispatch("cardClicked", {
                mission_id: mission.id,
            });
        }
    }
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<a
    href="/hub/missions/{mission.id}"
    on:click={handleClick}
    class="h-60 min-w-0 flex-grow cursor-pointer space-y-1 rounded-lg border-b-8 bg-gray-800 p-3 shadow-md hover:bg-gray-700 {cardColours(
        {
            mode: mission.mode,
            type: 'border',
        }
    )}"
>
    <div class="relative h-32 w-full overflow-hidden rounded-lg">
        <Lazy height={384}>
            <img
                class="absolute top-1/2 left-1/2 max-w-none -translate-x-1/2 -translate-y-1/2"
                src={mission.thumbnail ? mission.thumbnail : placeholder}
                loading="lazy"
                width="384"
                height="384"
                alt="thumbnail"
            />
        </Lazy>
    </div>
    <div class="space-y-0.5">
        <h5
            class="text-md truncate font-semibold tracking-tight {cardColours({
                mode: mission.mode,
                type: 'header',
            })}"
        >
            {mission.display_name}
        </h5>
        <div class="flex">
            <p class="flex-1 truncate text-xs font-normal text-gray-100">
                By {mission.user.username}
            </p>
            {#if !mission.verified_by}
                <svg class="h-4 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="orange">
                    <path
                        fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                        clip-rule="evenodd"
                    />
                </svg>
            {/if}
        </div>
        <p class="truncate text-xs font-normal text-gray-100">
            {mission.summary}
        </p>
    </div>
</a>
