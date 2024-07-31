<script lang="ts">
    import Subnav, { type SubnavItem } from "../../../../Hub/Missions/Mission/Subnav/Subnav.svelte";

    export let mission;

    let navigation: SubnavItem[] = [];

    mission.briefing_models.forEach(function (briefing) {
        let item: SubnavItem = { name: briefing.name, content: briefing, show: true };
        navigation.push(item);
    });
    let selected: SubnavItem = navigation[0];
</script>

<div>
    <Subnav bind:navigation bind:selected />

    {#each navigation as briefing}
        <div class={selected == briefing ? "" : "hidden"}>
            {#each Object.entries(briefing.content.sections) as [title, paragraph]}
                <div>
                    <h5 class="text-bold pt-8 text-center text-3xl tracking-wide text-gray-200">
                        {title}
                    </h5>
                    <p class="text-gray-200">{@html paragraph}</p>
                </div>
            {/each}
        </div>
    {/each}
</div>
