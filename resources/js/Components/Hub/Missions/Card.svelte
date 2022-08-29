<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    export let mission;
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<Link href="/hub/missions/{mission.id}" class="space-y-1 h-60 p-3 rounded-lg shadow-md border-b-8 border-b-rose-500 bg-gray-800 hover:bg-gray-700">
    <div class="h-32 rounded-lg bg-center bg-[url('/images/arcomm-placeholder.jpg')]"></div>
    <div class="space-y-0.5">
        <h5 class="truncate text-md font-semibold text-rose-500 tracking-tight">{mission.display_name}</h5>
        <p class="truncate text-xs font-normal text-gray-100">By {mission.user.username}</p>
        <p class="truncate text-xs font-normal text-gray-100">{mission.summary}</p>
    </div>
</Link>
