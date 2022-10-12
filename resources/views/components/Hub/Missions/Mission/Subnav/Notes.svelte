<script lang="ts">
    import Comments from "./Comments.svelte";

    export let mission;
</script>

<!-- <svelte:component> used in Subnav.svelte only loads new components, so we need to wrap <Comments/> in another component for the Subnav to work -->
<Comments {mission} comments={mission.notes} type={"notes"} />
