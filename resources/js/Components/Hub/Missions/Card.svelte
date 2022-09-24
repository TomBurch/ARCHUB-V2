<script lang="ts">
    import { Link, page } from "@inertiajs/inertia-svelte";
    import clb from "clb";
    export let mission;

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
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<Link
    href="/hub/missions/{mission.id}"
    class="h-60 space-y-1 rounded-lg border-b-8 bg-gray-800 p-3 shadow-md hover:bg-gray-700 {cardColours({
        mode: mission.mode,
        type: 'border',
    })}"
>
    <div class="h-32 rounded-lg bg-[url('/images/arcomm-placeholder.jpg')] bg-center" />
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
</Link>
