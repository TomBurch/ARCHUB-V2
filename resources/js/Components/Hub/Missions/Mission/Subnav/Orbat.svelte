<script lang="ts">
    import OrbatLevel from "./OrbatLevel.svelte";
    import Subnav from "./Subnav.svelte";

    export let mission;
    let navigation = [];

    /* Construct navigation dynamically so we can reuse Subnav*/

    for (let [faction, orbat] of Object.entries(mission.orbatSettings)) {
        navigation.push({ name: faction, content: orbat, show: true });
    }
    let selected = navigation[0];
</script>

<div>
    <Subnav bind:navigation bind:selected />

    {#each navigation as orbat}
        <div
            class="{selected == orbat
                ? ''
                : 'hidden'} prose ml-5 mt-3 max-w-none text-gray-200 prose-ul:my-0 prose-li:my-0"
        >
            <p>{mission.slottingDetails}</p>
            <OrbatLevel group={orbat.content} />
        </div>
    {/each}
</div>
