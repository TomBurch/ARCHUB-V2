<script lang="ts">
    export let mission

    let briefings = JSON.parse(mission.briefings);
</script>

<div>
    {#each briefings as briefing}
        <h4 class="text-gray-200">{briefing[0]}</h4>
        {#each Object.entries(briefing[3]) as [title, paragraph]}
            <h5 class="text-gray-200">{title}</h5>
            <p class="pt-5 text-gray-200">{@html paragraph}</p>
        {/each}
    {/each}
</div>
