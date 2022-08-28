<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    export let mission;
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<Link href="/hub/missions/{mission.id}" class="h-52 p-3 rounded-lg shadow-md border border-gray-700 bg-gray-800 hover:bg-gray-700">
    <div class="h-28 bg-center bg-[url('/images/arcomm-placeholder.jpg')]"></div>
    <div class="pt-4">
        <h5 class="truncate text-md font-semibold text-white tracking-tight">{mission.display_name}</h5>
        <p class="truncate text-xs font-normal text-gray-400">By {mission.user.username}</p>
        <p class="pb-3 truncate text-xs font-normal text-gray-400">{mission.summary}</p>
    </div>
</Link>
