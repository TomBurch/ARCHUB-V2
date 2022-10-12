<script lang="ts">
    export let group;
</script>

<li>{group[0]}</li>
<ul>
    {#if group[1]}
        {#each Object.values(group[1]) as level}
            <svelte:self group={level} />
        {/each}
    {/if}
</ul>
