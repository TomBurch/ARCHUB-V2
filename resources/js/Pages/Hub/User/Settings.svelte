<script lang="ts" context="module">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { page } from "@inertiajs/inertia-svelte";

    export let avatar;
</script>

<div class="h-screen-no-nav border border-gray-200 border-gray-700 bg-gray-800 p-3 shadow-md">
    <h5 class="pb-2 text-center text-3xl font-bold text-white">Settings</h5>
    <img class="mx-auto rounded-lg" src={avatar} alt="" />
    <p class="text-center text-lg font-normal text-white">
        {$page.props.auth.user.username}
    </p>
</div>
