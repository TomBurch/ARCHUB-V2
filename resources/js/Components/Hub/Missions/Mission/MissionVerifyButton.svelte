<script lang="ts">
    import { page, useForm } from '@inertiajs/inertia-svelte'

    export let mission;

    let form = useForm({
        verified_by: null,
    })

    function handleVerify() {
        mission.verified_by = (mission.verified_by === null) ? $page.props.auth.user.id : null;
        $form.verified_by = (mission.verified_by === null) ? null : $page.props.auth.user;
        
        $form.patch(`/hub/missions/${mission.id}`);
    }
</script>

<button on:click|preventDefault={handleVerify}>
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke={mission.verified_by === null ? "red" : "green"} class="w-7 h-7">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
</button>
