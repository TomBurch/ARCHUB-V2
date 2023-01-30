<script lang="ts">
    export let category;
</script>

<li>{category.name}</li>
<ul>
    {#each category.groups as group}
        <li>{group.name}</li>
        <ul>
            {#each group.units as unit}
                <li>{unit}</li>
            {/each}
        </ul>
    {/each}
    {#each Object.values(category.subcategories) as subcategory}
        <svelte:self category={subcategory} />
    {/each}
</ul>
