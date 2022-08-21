<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    export let mission;
</script>

<!-- Adapted from https://flowbite.com/docs/components/card/#default-card -->
<Link href="/hub" id='mission-card'class="block p-6 bg-white rounded-lg border border-gray-200 shadow-md hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <img class="rounded-t-lg h-52" src="/images/arcomm-placeholder.jpg" alt="">
    <h5 class="truncate mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{mission.display_name}</h5>
    <p class="truncate font-normal text-gray-700 dark:text-gray-400">{mission.summary}</p>
</Link>
