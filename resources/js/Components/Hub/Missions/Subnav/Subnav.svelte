<script lang="ts">
    export let navigation
    export let selected
    let open = false
</script>

<!-- Adapted from https://tailwindui.com/components/application-ui/navigation/navbars#component-70a9bdf83ef2c8568c5cddf6c39c2331 -->
<nav class="bg-gray-900 rounded-lg">
    <div class="px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button type="button" on:click="{() => open = !open}"class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{open ? 'M6 18L18 6M6 6l12 12' : 'M4 6h16M4 12h16M4 18h16'}" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex space-x-4">
                        {#each navigation as item}
                            <button on:click="{() => selected = item}" class="{selected.name == item.name ? 'border-b-4 border-b-indigo-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'} px-3 py-2 rounded-t-md text-md font-medium">{item.name}</button>
                        {/each}
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <div class='sm:hidden' id="mobile-menu">
        <div class="{open ? '' : 'hidden'} px-2 pt-2 pb-3 space-y-1">
            {#each navigation as item}
                <button on:click="{() => selected = item}" class="{selected.name == item.name ? 'border-b-4 border-b-indigo-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'} block px-3 py-2 rounded-t-md text-md font-medium">{item.name}</button>
            {/each}
        </div>
    </div>
</nav>
