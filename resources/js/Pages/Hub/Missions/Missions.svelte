<script lang="ts" context="module">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { page } from "@inertiajs/inertia-svelte";
    import MissionCollection from "../../../Components/Hub/Missions/Mission/MissionCollection.svelte";

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
</script>

<div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 2xl:grid-cols-6">
    <MissionCollection title={"Next operation"} missions={next_op_missions} />
    <MissionCollection title={"My missions"} missions={my_missions} uploadCard={true} />
    <MissionCollection title={"Unplayed missions"} missions={unplayed_missions} />
    <MissionCollection title={"Played missions"} missions={played_missions} />
</div>
