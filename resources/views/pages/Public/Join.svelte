<script lang="ts" context="module">
    import Layout from "./Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { page } from "@inertiajs/inertia-svelte";
</script>

<!-- Adapted from https://v1.tailwindcss.com/components/forms#form-grid -->
<form class="h-screen-no-nav border border-gray-200 border-gray-700 bg-gray-800 p-3 shadow-md">
    <div class="-mx-3 mb-6 flex flex-wrap">
        <div class="mb-6 w-full px-3 md:mb-0 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-name">
                Your name
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-red-500 bg-gray-200 py-3 px-4 leading-tight text-gray-700 focus:bg-white focus:outline-none"
                id="grid-name"
                type="text"
            />
            <p class="text-xs italic text-red-500">Please fill out this field.</p>
        </div>
        <div class="w-full px-3 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-age">
                Your age
            </label>
            <input
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-age"
                type="text"
            />
        </div>
    </div>
    <div class="-mx-3 mb-6 flex flex-wrap">
        <div class="mb-6 w-full px-3 md:mb-0 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-location">
                Location
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-location"
            />
            <p class="text-xs italic text-gray-400">Make it as long and as crazy as you'd like</p>
        </div>
        <div class="mb-6 w-full px-3 md:mb-0 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-weekly">
                Are you available for weekly operations?
            </label>
            <div class="relative">
                <select
                    class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 pr-8 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                    id="grid-weekly"
                >
                    <option>No</option>
                    <option>Yes</option>
                </select>
            </div>
        </div>
    </div>
    <div class="-mx-3 mb-6 flex flex-wrap">
        <div class="mb-6 w-full px-3 md:mb-0 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-discord">
                Discord account
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-discord"
                type="text"
            />
        </div>
        <div class="mb-6 w-full px-3 md:mb-0 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-steam">
                Steam account
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-steam"
                type="text"
            />
        </div>
    </div>
    <div class="-mx-3 mb-6 flex flex-wrap">
        <div class="mb-6 w-full px-3 md:mb-0 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-discord">
                Discord account
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-discord"
                type="text"
            />
        </div>
        <div class="mb-6 w-full px-3 md:mb-0 md:w-1/2">
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-steam">
                Steam account
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-steam"
                type="text"
            />
        </div>
    </div>
</form>
