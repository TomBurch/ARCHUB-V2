<script lang="ts">
    import { Link, page } from '@inertiajs/inertia-svelte'
    import Navbar from '../../Components/Navbar.svelte'

    const navigation = [
        { name: 'Home', href: '/', inert: true},
        { name: 'Missions', href: '/hub/missions', inert: true},
    ]
</script>

<main>
    <Navbar navigation={navigation}/>
    <article class="m-10">
        <slot />
    </article>
</main>
