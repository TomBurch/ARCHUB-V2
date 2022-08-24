<script lang="ts">
    import Layout from '../Layout.svelte'
    export let user;
</script>
  
<Layout>
    <div class="block h-screen p-3 border border-gray-200 shadow-md bg-gray-800 border-gray-700">
        <h5 class="pb-2 text-center text-3xl font-bold text-white">Settings</h5>
        <img class="mx-auto rounded-lg" src="{user.avatar}" alt="">
        <p class="text-center text-lg font-normal text-white">{user.username}</p>
    </div>
</Layout>
