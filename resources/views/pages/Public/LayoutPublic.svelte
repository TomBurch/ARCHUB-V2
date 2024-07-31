<script lang="ts">
    import { Link, page } from "@inertiajs/inertia-svelte";
</script>

<main>
    <img class="absolute m-8 h-14 w-14 sm:h-28 sm:w-28" src="/images/logo-white-full.png" alt="Logo" />
    <div class="absolute flex w-full justify-end p-8 text-white">
        <div>
            <Link
                href={"/join"}
                class="rounded-md border-2 border-blue-900 bg-blue-700 p-2 font-semibold uppercase hover:bg-blue-900"
                >Apply now</Link
            >
            {#if $page.props.auth.user}
                <Link href="/hub" class="text-md rounded-md px-3 py-2 font-medium hover:bg-gray-700">Hub</Link>
            {:else}
                <a href="/auth/redirect" class="text-md rounded-md px-3 py-2 font-medium hover:bg-gray-700">Login</a>
            {/if}
        </div>
    </div>
    <slot />
</main>
