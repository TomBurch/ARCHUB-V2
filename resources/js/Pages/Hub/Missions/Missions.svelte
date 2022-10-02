<script lang="ts" context="module">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { Inertia } from "@inertiajs/inertia";
    import { page } from "@inertiajs/inertia-svelte";
    import MissionCollection from "../../../Components/Hub/Missions/MissionCollection.svelte";
    import OperationSelection from "../../../Components/Hub/Missions/OperationSelection.svelte";

    export let missions;
    export let next_operation;
    export let can;

    $: next_op_missions = next_operation.missions.map((mission) => mission.mission);
    $: my_missions = missions.filter((mission) => mission.user.id == $page.props.auth.user.id);
    $: unplayed_missions = missions.filter(
        (mission) => !mission.last_played && (mission.verified_by || can.test_missions)
    );
    $: played_missions = missions.filter(
        (mission) => mission.last_played && (mission.verified_by || can.test_missions)
    );

    let selecting = null;
    let shouldRedirect = true;

    function handleSelecting(event) {
        shouldRedirect = selecting ? false : true;
    }

    function handleCardClicked(event) {
        Inertia.put(
            `/hub/operations/${next_operation.id}`,
            {
                play_order: selecting,
                mission_id: event.detail.mission_id,
            },
            { preserveScroll: true }
        );
        selecting = null;
        shouldRedirect = true;
    }
</script>

<div>
    {#if can.manage_operations}
        <OperationSelection {next_operation} bind:selecting on:selecting={handleSelecting} />
    {:else}
        <MissionCollection
            title={"Next operation"}
            missions={next_op_missions}
            bind:shouldRedirect
            on:cardClicked={handleCardClicked}
        />
    {/if}
    <MissionCollection
        title={"My missions"}
        missions={my_missions}
        uploadCard={true}
        bind:shouldRedirect
        on:cardClicked={handleCardClicked}
    />
    <MissionCollection
        title={"Unplayed missions"}
        missions={unplayed_missions}
        bind:shouldRedirect
        on:cardClicked={handleCardClicked}
    />
    <MissionCollection
        title={"Played missions"}
        missions={played_missions}
        open={false}
        bind:shouldRedirect
        on:cardClicked={handleCardClicked}
    />
</div>
