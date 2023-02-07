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
        let text = `${join_status.status.text} · ${join_status.total}`
        let item: SubnavItem = { name: text, content: {name: join_status.status.text, id: join_status.status_id}, show: true }
        navigation.push(item);
    });

    let selected: SubnavItem = navigation[0];
    let search: string = "";

    let timer;
    const debounce = (e) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            onSearch();
        }, 50);
    };

    $: if (selected) {
        onSearch();
    };

    $: if (true) {
        debounce(search);
    };

    function onSearch() {
        let body;
        if (search) {
            body = {status: selected.content.name, search: search}  
        } else {
            body = {status: selected.content.name}
        }

        Inertia.get('/hub/applications', body, {
            preserveState: true,
            preserveScroll: true,
        })
    };
</script>

<div class="mx-auto min-h-screen-no-nav border border-gray-700 bg-gray-800 p-3 shadow-md lg:w-4/5">
    <Subnav bind:navigation bind:selected centered={true}/>
    <div class="mx-auto my-5 w-full max-w-5xl">
        <div class="flex items-center pb-3">   
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute flex items-center inset-y-0 left-0 pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input bind:value={search} type="text" id="simple-search" class="block w-full pl-10 p-2.5 rounded-md bg-gray-700 border border-gray-600 text-sm text-white placeholder-gray-400 focus:ring-blue-500 focus:border-blue-500" placeholder="Search" required>
            </div>
        </div>

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
