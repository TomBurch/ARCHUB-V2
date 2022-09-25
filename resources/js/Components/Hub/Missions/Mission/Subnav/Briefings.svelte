<script lang="ts">
    import Subnav from "./Subnav.svelte";

    export let mission;

    let navigation = [];

    /* Construct navigation dynamically so we can reuse Subnav*/
    mission.briefing_models.forEach(function (briefing) {
        navigation.push({ name: briefing.name, content: briefing.sections, show: true });
    });
    let selected = navigation[0];
</script>

<div>
    <Subnav bind:navigation bind:selected />

    {#each navigation as briefing}
        <div class={selected == briefing ? "" : "hidden"}>
            {#each Object.entries(briefing.content) as [title, paragraph]}
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
