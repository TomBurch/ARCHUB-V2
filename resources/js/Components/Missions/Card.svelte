<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    export let mission;
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<Link href="/hub" id='mission-card' class="block h-52 p-3 rounded-lg border border-gray-200 shadow-md bg-gray-800 border-gray-700 hover:bg-gray-700">
    <img class="h-[50%] rounded-t-lg" src="/images/arcomm-placeholder.jpg" alt="">
    <h5 class="truncate align-bottom pt-7 text-xl font-bold text-white tracking-tight">{mission.display_name}</h5>
    <p class="truncate align-bottom text-sm font-normal text-gray-400">By {mission.user.username}</p>
    <p class="truncate align-bottom text-sm font-normal text-gray-400">{mission.summary}</p>
</Link>
