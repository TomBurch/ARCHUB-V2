<script lang="ts">
    import OrbatCategory from "./OrbatCategory.svelte";
    import OrbatLevel from "./OrbatLevel.svelte";
    import Subnav, { type SubnavItem } from "./Subnav.svelte";

    export let mission;
    export let can;

    let navigation: SubnavItem[] = [];
    let orbats = mission.orbats ? mission.orbats : mission.orbatSettings
    
    for (let [faction, orbat] of Object.entries(orbats)) {
        let item: SubnavItem = { name: faction, content: orbat, show: true }
        navigation.push(item);
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
            {#if mission.orbats}
                <OrbatCategory category={orbat.content} />
            {:else}
                <OrbatLevel group={orbat.content} />
            {/if}
        </div>
    {/each}
</div>
