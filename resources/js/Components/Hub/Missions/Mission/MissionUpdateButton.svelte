<script lang="ts">
    import { useForm } from '@inertiajs/inertia-svelte'

    export let mission;

    let form = useForm({
        mission: null,
    })

    function submit() {
        $form.post(`/hub/missions/${mission.id}/update`);
    }

    function handleDrop(event) {
        event.preventDefault();
        event.stopPropagation();
        $form.mission = event.dataTransfer.files[0];
        submit();
    }

    function handleDragOver(event) {
        event.preventDefault()
        if (event.dataTransfer) {
            event.dataTransfer.dropEffect = "copy";
        }
    }
</script>

<!-- Adapted from https://flowbite.com/docs/forms/file-input/#dropzone -->
<div class="inline-flex" on:drop={handleDrop} on:dragover={handleDragOver}>
    <label for="dropzone-file" class="items-center rounded-lg border-2 border-dashed cursor-pointer bg-gray-700 border-gray-600 hover:border-gray-500 hover:bg-gray-600">
        <div class="">
            {#if !$form.progress}
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
            {:else}
                <progress class="" value={$form.progress.percentage} max="100">{$form.progress.percentage}%</progress>
            {/if}
        </div>
        <form>
            <input id="dropzone-file" type="file" class="hidden" on:input={e => $form.mission = e.target.files[0]} on:change={submit}>
        </form>
    </label>
</div>
