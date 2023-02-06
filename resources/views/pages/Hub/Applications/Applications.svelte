<script lang="ts" context="module">
    import Layout from "../Layout.svelte";
    export const layout = Layout;
</script>

<script lang="ts">
    import { Inertia } from "@inertiajs/inertia";
    import { DateTime } from "luxon";
    import Subnav, { type SubnavItem } from "../../../Components/Hub/Missions/Mission/Subnav/Subnav.svelte";

    type Application = {
        name: string,
        age: number,
        created_at: any
        location: string,
        email: string,
        steam: string,
        discord: string,
        available: boolean,
        experience: string,
        bio: string,
        source_text: string,
        status_id: any,
        source_id: any,
    };

    type JoinStatus = {
        status_id: number,
        total: number,
        status: {
            id: number,
            text: string
        },
    }

    export let applications: Application[];
    export let statuses: JoinStatus[];

    let navigation: SubnavItem[] = [];

    statuses.forEach(function (join_status) {
        let text = `${join_status.status.text} - ${join_status.total}`
        let item: SubnavItem = { name: text, content: {name: join_status.status.text, id: join_status.status_id}, show: true }
        navigation.push(item);
    });

    let selected: SubnavItem = navigation[0];

    $: if (selected) {
        Inertia.get('/hub/applications', { status: selected.content.name }, {
            preserveState: true,
            preserveScroll: true,
        })
    };
</script>

<div class="mx-auto min-h-screen-no-nav border border-gray-700 bg-gray-800 p-3 shadow-md lg:w-4/5">
    <Subnav bind:navigation bind:selected centered={true}/>
    <div class="mx-auto my-5 w-full max-w-5xl bg-white">
        <ul class="flex flex-col">
            {#each applications as application}
                <li class="border-b-2 border-gray-500">
                    <div class="flex flex-col py-3 px-4 justify-between border-l-4 border-transparent bg-gray-900 hover:border-purple-800">
                        <p class="text-gray-200 font-semibold">{application.name}</p>
                        <p class="text-sm text-gray-200 text-opacity-60">{application.age}, {application.location} · {DateTime.fromISO(application.created_at).toRelative()}</p>
                    </div>
                </li>
            {/each}
        </ul>
    </div>
</div>
