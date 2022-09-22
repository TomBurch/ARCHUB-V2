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
        <p class="truncate text-xs font-normal text-gray-100">
            By {mission.user.username}
        </p>
        <p class="truncate text-xs font-normal text-gray-100">
            {mission.summary}
        </p>
    </div>
</Link>
