<script lang="ts">
    import Navbar, { type NavItem } from "../../Components/Hub/Navbar.svelte";
    import { page } from "@inertiajs/inertia-svelte";

    const navigation: NavItem[] = [
        { name: "Home", href: "/", inert: true, show: true },
        { name: "Missions", href: "/hub/missions", inert: true, show: true },
        { name: "Applications", href: "/hub/applications", inert: true, show: $page.props.auth.can.view_applications },
    ];
</script>

<main>
    <Navbar {navigation} />
    <article class="m-10">
        <slot />
    </article>
</main>
