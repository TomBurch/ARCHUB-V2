<script lang="ts" context="module">
    import Layout from "./Layout.svelte";
    export const layout = Layout;
</script>

<!-- Adapted from https://v1.tailwindcss.com/components/forms#form-grid -->
<form class="mx-auto min-h-screen-no-nav border border-gray-700 bg-gray-800 p-3 shadow-md lg:w-4/5" id="join-form">
    <div class="text-center text-gray-200">
        <h1 class="text-2xl font-bold lg:text-2xl">JOIN ARCOMM</h1>
        <p class="mt-4">
            We're looking for well adjusted people who listen to and respect others. While having experience in our
            games is welcome, it's in no way required. Aspiring members should make an effort to attend the weekly
            operations, be accountable for their actions, and generally have a good sense of humor.
        </p>
    </div>
    <hr class="my-8 h-px bg-gray-200" />
    <div class="grid grid-cols-1 gap-x-3 gap-y-3 md:grid-cols-2">
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-name">
                Your name
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border bg-gray-200 py-3 px-4 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-name"
                type="text"
                placeholder="Name"
                required
            />
            <p class="text-xs text-gray-400">This should be the name you use in game</p>
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-age">
                Your age
            </label>
            <input
                class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-age"
                type="text"
                placeholder="e.g. 27"
                required
            />
        </div>

        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-location">
                Location
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-location"
                placeholder="Location"
                required
            />
            <p class="text-xs text-gray-400">You can be as specific as you like</p>
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-weekly">
                Are you available for weekly operations?
            </label>
            <div class="relative">
                <select
                    class="block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 pr-8 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                    id="grid-weekly"
                    required
                >
                    <option value="" disabled selected class="text-gray-200">Please Select an Option</option>
                    <option>No</option>
                    <option>Yes</option>
                </select>
            </div>
            <p class="mt-2 text-xs text-gray-400">
                Arma - Saturday at 1800 Zulu
                <br />
                DCS - Sunday at 1800 Zulu
            </p>
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-discord">
                Discord Username
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-discord"
                type="text"
                placeholder="Your Discord Username"
                required
            />
            <p class="text-xs text-gray-400">Discord > Left-Click profile in the bottom left > Copy Username</p>
            <p class="text-xs text-gray-400">
                Please join <a class="text-red-500 hover:text-red-600" href="https://discord.com/invite/7ehwg7F"
                    >our Discord Server</a
                > so that we can contact you about your application
            </p>
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-steam">
                Steam account
            </label>
            <input
                class="mb-3 block w-full appearance-none rounded border border-gray-200 bg-gray-200 py-3 px-4 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-steam"
                type="text"
                placeholder="Profile URL"
                required
            />
            <p class="text-xs text-gray-400">Steam > Your Profile > Right-Click > Copy Page URL</p>
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-experience">
                Your Game Experience
            </label>
            <textarea
                class="mb-3 block w-full appearance-none rounded border bg-gray-200 py-3 px-4 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-experience"
                placeholder="Game Experience"
                rows="6"
                required
            />
            <p class="text-xs text-gray-400">
                Give us a short description of your experience with the game, what mods you've used etc
            </p>
        </div>
        <div>
            <label class="mb-2 block text-xs font-bold uppercase tracking-wide text-gray-200" for="grid-about">
                About Yourself
            </label>
            <textarea
                class="mb-3 block w-full appearance-none rounded border bg-gray-200 py-3 px-4 leading-tight text-gray-700 invalid:border-red-500 focus:border-gray-500 focus:bg-white focus:outline-none"
                id="grid-about"
                placeholder="About Yourself"
                rows="6"
                required
            />
            <p class="text-xs text-gray-400">
                Tell us a bit about yourself and how you think you would contribute as a member.
                <br />
                The more you write the better! This part is very important. Sharing a bit about yourself goes a long way
                - we're not looking for one-liners
            </p>
        </div>
    </div>
    <div class="mt-3 content-center">
        <button
            class="btn rounded bg-red-500 py-2 px-4 font-bold text-gray-200 shadow hover:bg-red-600"
            type="submit"
            value="Submit"
            form="join-form">Submit Application</button
        >
    </div>
</form>
