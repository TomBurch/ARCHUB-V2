<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    import Navbar from '../../Components/Navbar.svelte'

    const navigation = [
        { name: 'Login', href: '/auth/redirect', inert: false},
        { name: 'Join', href: '/join', inert: true},
    ]
</script>

<main>
    <Navbar navigation={navigation}/>
    <article class="m-10">
        <slot />
    </article>
</main>
