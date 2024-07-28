<script lang="ts" context="module">
    import LayoutPublic from "./LayoutPublic.svelte";
    export const layout = LayoutPublic;
</script>

<script lang="ts">
    import Card from "../../Components/Hub/Missions/Card.svelte";

    export let missions;
</script>

<div class="size-full">
    <div class="h-screen-no-nav-margin bg-blue-700">
        <div class="absolute bottom-0 flex w-screen justify-center bg-black py-12 text-center text-white">
            <div class="max-w-[60%]">
                <h4 class="mb-2 text-3xl font-thin">Arma-Centric Family of Gamers</h4>
                <p class="text-xl font-extralight leading-9">
                    We pride ourselves on the absence of ranks and strict military structure. Our players range from
                    former mil-sim players to beginners of Arma. Our goal is to take advantage of what Arma does best
                    and provide a great experience to all involved.<br />Everyone is considered an equal member. No one
                    holds the power to command anyone else outside of gameplay.<br />
                </p>
            </div>
        </div>
    </div>
    <div class="flex h-screen items-center justify-center bg-red-700">
        <div class="grid max-h-[60%] max-w-[60%] grid-cols-2 grid-rows-2 gap-6 text-center text-white">
            <div>
                <h4 class="mb-2 text-3xl font-thin">Team</h4>
                <p class="text-xl font-extralight leading-9">
                    There is no formal ranking. You will never have to call someone 'sir' or adhere to unnecessary
                    requirements. Respect is earned, not given.
                </p>
            </div>
            <div>
                <h4 class="mb-2 text-3xl font-thin">Gameplay</h4>
                <p class="text-xl font-extralight leading-9">
                    We enforce first person and non-magnified/thermal optics on our servers for added immersion and to
                    make the gameplay more challenging and fair.
                </p>
            </div>
            <div>
                <h4 class="mb-2 text-3xl font-thin">Missions</h4>
                <p class="text-xl font-extralight leading-9">
                    Play a wide range of scenarios, both cooperative and adversarial. We don't limit ourselves to a
                    particular faction or style, each week is different in some way.
                </p>
            </div>
            <div>
                <h4 class="mb-2 text-3xl font-thin">Discussion</h4>
                <p class="text-xl font-extralight leading-9">
                    Active discussions on our Discord & TS. Voice your opinions and ideas, keep up-to-date with events
                    and collaborate with other members.
                </p>
            </div>
        </div>
    </div>
    <div class="flex h-screen bg-white" />
    <div class="flex h-screen flex-col items-center justify-center bg-red-700 text-center text-white">
        <div class="mb-10">
            <h1 class="mb-3 text-7xl font-thin">
                ARC<b class="font-bold">HUB</b>
            </h1>
            <p class="text-3xl font-extralight leading-9">Built in-house, our community mission suite.</p>
        </div>
        <div class="col-span-full grid max-w-[55%] grid-cols-3 gap-5">
            {#each missions as mission}
                <Card shouldRedirect={true} {mission} on:cardClicked />
            {/each}
        </div>
    </div>
    <div class="flex h-screen bg-black" />
    <div class="flex h-screen bg-blue-700" />
</div>
