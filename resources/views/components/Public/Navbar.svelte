<script lang="ts">
    import { Link, page } from "@inertiajs/inertia-svelte";

    const navigation = [
        // { name: "Join", href: "/join" }
    ];
    let open = false;
</script>

<!-- Adapted from https://tailwindui.com/components/application-ui/navigation/navbars#component-70a9bdf83ef2c8568c5cddf6c39c2331 -->
<nav class="bg-gray-800">
    <div class="px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-14 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button
                    type="button"
                    on:click={() => (open = !open)}
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu"
                    aria-expanded="false"
                >
                    <svg
                        class="block h-6 w-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d={open ? "M6 18L18 6M6 6l12 12" : "M4 6h16M4 12h16M4 18h16"}
                        />
                    </svg>
                </button>
            </div>
            <div class="flex flex-1 items-center sm:items-stretch sm:justify-start">
                <div class="flex flex-shrink-0 items-center">
                    <img class="hidden h-8 w-auto sm:block" src="/images/logo.png" alt="Logo" />
                </div>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        {#if $page.props.auth.user}
                            <Link
                                href="/hub"
                                class="text-md rounded-md px-3 py-2 font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                >Hub</Link
                            >
                        {:else}
                            <a
                                href="/auth/redirect"
                                class="text-md rounded-md px-3 py-2 font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                                >Login</a
                            >
                        {/if}
                        {#each navigation as item}
                            <Link
                                href={item.href}
                                class="{$page.url == item.href
                                    ? 'bg-gray-900 text-white'
                                    : 'text-gray-300 hover:bg-gray-700 hover:text-white'} text-md rounded-md px-3 py-2 font-medium"
                                >{item.name}</Link
                            >
                        {/each}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sm:hidden" id="mobile-menu">
        <div class="{open ? '' : 'hidden'} space-y-1 px-2 pt-2 pb-3">
            {#if $page.props.auth.user}
                <Link
                    href="/hub"
                    class="text-md block rounded-md px-3 py-2 font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                    >Hub</Link
                >
            {:else}
                <a
                    href="/auth/redirect"
                    class="text-md block rounded-md px-3 py-2 font-medium text-gray-300 hover:bg-gray-700 hover:text-white"
                    >Login</a
                >
            {/if}
            {#each navigation as item}
                <Link
                    href={item.href}
                    class="{$page.url == item.href
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-300 hover:bg-gray-700 hover:text-white'} text-md block rounded-md px-3 py-2 font-medium"
                    >{item.name}</Link
                >
            {/each}
        </div>
    </div>
</nav>
