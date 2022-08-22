<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    export let mission;
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<Link href="/missions/{mission.id}" class="rounded-lg border border-gray-700 shadow-md bg-green-800">
    <img class="px-5" src="/images/arcomm-placeholder.jpg" alt="">
    <div class="px-5 bg-gray-800">
        <h5 class="truncate text-xl font-bold text-white tracking-tight">{mission.display_name}</h5>
        <p class="truncate text-sm font-normal text-gray-400">By {mission.user.username}</p>
        <p class="truncate text-sm font-normal text-gray-400">{mission.summary}</p>
    </div>
</Link>
