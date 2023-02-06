<script lang="ts">
    import { page, useForm } from "@inertiajs/inertia-svelte";
    import Subnav, { type SubnavItem } from "./Subnav.svelte";

    export let mission;
    export let can;

    let navigation: SubnavItem[] = [];

    mission.briefing_models.forEach(function (briefing) {
        let item: SubnavItem = { name: briefing.name, content: briefing, show: true }
        navigation.push(item);
    });
    let selected: SubnavItem = navigation[0];

    let form = useForm({
        locked: null,
    });

    function handleLock() {
        $form.locked = !selected.content.locked;
        $form.put(`/hub/missions/${mission.id}/briefings/${selected.content.id}`, {
            preserveScroll: true,
        });
        selected.content.locked = $form.locked;
    }
</script>

<div>
    <Subnav bind:navigation bind:selected />

    {#each navigation as briefing}
        <div class={selected == briefing ? "" : "hidden"}>
            <button on:click={handleLock} class="float-right px-2 pt-2">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="2.5"
                    stroke="slateblue"
                    class="h-6 w-6"
                >
                    {#if mission.user.id == $page.props.auth.user.id}
                        {#if briefing.content.locked}
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                            />
                        {:else}
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M13.5 10.5V6.75a4.5 4.5 0 119 0v3.75M3.75 21.75h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"
                            />
                        {/if}
                    {/if}
                </svg>
            </button>
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
