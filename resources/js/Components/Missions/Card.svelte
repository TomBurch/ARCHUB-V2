<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    export let mission;
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<Link href="/missions/{mission.id}" class="h-52 p-3 rounded-lg border border-gray-700 shadow-md bg-gray-800">
    <img class="h-[50%] rounded-lg" src="/images/arcomm-placeholder.jpg" alt="">
    <div class="pt-5">
        <h5 class="truncate text-md font-semibold text-white tracking-tight">{mission.display_name}</h5>
        <p class="truncate text-xs font-normal text-gray-400">By {mission.user.username}</p>
        <p class="pb-3 truncate text-xs font-normal text-gray-400">{mission.summary}</p>
    </div>
</Link>
