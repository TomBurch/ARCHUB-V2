<script lang="ts" context="module">
    import LayoutPublic from "./LayoutPublic.svelte";
    export const layout = LayoutPublic;
</script>

<script lang="ts">
    import Card from "../../Components/Hub/Missions/Card.svelte";
    import { Link } from "@inertiajs/inertia-svelte";
    import { onDestroy, onMount } from "svelte";

    export let missions;
    export let banners: string[];

    let timer;
    onMount(() => {
        let timer = setInterval(next, 5000);
    });
    onDestroy(() => {
        clearInterval(timer);
    });

    let i = 0;
    function next() {
        i += 1;
        if (i >= banners.length) {
            i = 0;
        }
    }
    $: currentBanner = banners[i];
</script>

<div class="size-full">
    <div
        style="background-image: url('{currentBanner}')"
        class="h-screen-no-nav-margin bg-black bg-cover bg-center bg-no-repeat"
    >
        <div
            class="absolute bottom-0 flex w-screen justify-center bg-black py-5 text-center text-white opacity-90 lg:py-8"
        >
            <div class="max-w-[90%] md:max-w-[75%] lg:max-w-[60%]">
                <h4 class="mb-2 text-2xl font-thin sm:text-3xl">Arma-Centric Family of Gamers</h4>
                <p class="font-extralight leading-6 md:text-lg md:leading-7 lg:text-xl lg:leading-9">
                    We pride ourselves on the absence of ranks and strict military structure. Our players range from
                    former mil-sim players to beginners of Arma. Our goal is to take advantage of what Arma does best
                    and provide a great experience to all involved.<br />Everyone is considered an equal member. No one
                    holds the power to command anyone else outside of gameplay.<br />
                </p>
            </div>
        </div>
    </div>
    <div class="flex h-screen items-center justify-center bg-red-700">
        <div
            class="grid max-h-[60%] max-w-[90%] grid-cols-2 grid-rows-2 gap-6 text-center text-white md:max-w-[75%] lg:max-w-[60%]"
        >
            <div>
                <h4 class="mb-2 text-2xl font-thin sm:text-3xl">Team</h4>
                <p class="font-extralight leading-6 md:text-lg lg:leading-9">
                    There is no formal ranking. You will never have to call someone 'sir' or adhere to unnecessary
                    requirements. Respect is earned, not given.
                </p>
            </div>
            <div>
                <h4 class="mb-2 text-2xl font-thin sm:text-3xl">Gameplay</h4>
                <p class="font-extralight leading-6 md:text-lg lg:leading-9">
                    We enforce first person and non-magnified/thermal optics on our servers for added immersion and to
                    make the gameplay more challenging and fair.
                </p>
            </div>
            <div>
                <h4 class="mb-2 text-2xl font-thin sm:text-3xl">Missions</h4>
                <p class="font-extralight leading-6 md:text-lg lg:leading-9">
                    Play a wide range of scenarios, both cooperative and adversarial. We don't limit ourselves to a
                    particular faction or style, each week is different in some way.
                </p>
            </div>
            <div>
                <h4 class="mb-2 text-2xl font-thin sm:text-3xl">Discussion</h4>
                <p class="font-extralight leading-6 md:text-lg lg:leading-9">
                    Active discussions on our Discord & TS. Voice your opinions and ideas, keep up-to-date with events
                    and collaborate with other members.
                </p>
            </div>
        </div>
    </div>
    <div class="flex h-screen bg-white" />
    <div class="flex h-screen flex-col items-center justify-center bg-red-700 text-center text-white">
        <div class="mb-5 sm:mb-10">
            <h1 class="mb-1 text-5xl font-thin sm:mb-3 sm:text-7xl">
                ARC<b class="font-bold">HUB</b>
            </h1>
            <p class="text-3xl font-extralight leading-9 sm:text-3xl">Built in-house, our community mission suite.</p>
        </div>
        <div
            class="col-span-full grid max-w-[60%] grid-cols-1 gap-5 sm:max-w-[50%] md:max-w-[70%] md:grid-cols-3 lg:max-w-[55%]"
        >
            {#each missions as mission}
                <Card shouldRedirect={true} {mission} on:cardClicked shared={true} />
            {/each}
        </div>
    </div>
    <div class="flex h-screen bg-black" />
    <div
        style="background-image: url('/images/banners/5.jpg')"
        class="h-screen bg-black bg-cover bg-fixed bg-center bg-no-repeat"
    >
        <div class="flex h-screen flex-col items-center justify-center text-white">
            <h1 class="mb-7 text-5xl font-bold uppercase">Are you ready?</h1>
            <Link
                href={"/join"}
                class="rounded-md border-2 border-blue-900 bg-blue-700 p-2 font-semibold uppercase hover:bg-blue-900"
                >Submit your application</Link
            >
        </div>
    </div>
</div>
