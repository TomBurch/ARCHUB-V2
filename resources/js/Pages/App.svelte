<script lang="ts">
    import Layout from './Layout.svelte'
    import { page } from '@inertiajs/inertia-svelte'
</script>
  
<Layout>
    <h1>Welcome</h1>
    <p>Hello welcome to your first Inertia app!</p>
    {#if $page.props.user }
	    <p>Logged in</p>
    {:else}
        <p>Not logged in</p>
    {/if}
</Layout>
