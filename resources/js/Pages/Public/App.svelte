<script lang="ts">
    import Layout from './Layout.svelte'
    import { Link, page } from '@inertiajs/inertia-svelte'
</script>
  
<Layout>
    <div class="grid place-items-center h-screen-no-nav p-3 border border-gray-200 shadow-md bg-gray-800 border-gray-700">
        <div class="grid grid-cols-2 gap-4 text-center">
            {#if $page.props.user}
                <Link href='/hub' class="text-gray-300 bg-gray-900 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-md font-medium">Hub</Link>
            {:else}
             <a href='/auth/redirect' class="text-gray-300 bg-gray-900 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-md font-medium">Login</a>
            {/if}       
            <Link href='/join' class="text-gray-300 bg-gray-900 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-md font-medium">Join</Link>
        </div>
    </div>
</Layout>
