<script lang="ts">
    import { page, useForm } from "@inertiajs/inertia-svelte";

    export let mission;

    let form = useForm({
        verified_by: null,
    });

    function handleVerify() {
        mission.verified_by = mission.verified_by === null ? $page.props.auth.user.id : null;
        $form.verified_by = mission.verified_by === null ? null : $page.props.auth.user;

        $form.patch(`/hub/missions/${mission.id}`);
    }
</script>

<button on:click|preventDefault={handleVerify}>
    <div class="rounded-2xl border-2 {mission.verifier ? 'border-green-700 px-1' : 'border-red-700'}">
        <div class="flex">
            {#if mission.verifier}
                <p class="flex px-0.5 pt-0.5 text-sm font-semibold text-gray-300">
                    {mission.verifier.username}
                </p>
            {/if}
            <div class="flex">
                <svg
                    class="h-6 w-6"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 18"
                    fill={mission.verifier ? "green" : "red"}
                >
                    <path
                        fill-rule="evenodd"
                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                        clip-rule="evenodd"
                    />
                </svg>
            </div>
        </div>
    </div>
</button>
