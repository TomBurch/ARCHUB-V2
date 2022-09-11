<script>
    import { useForm } from '@inertiajs/inertia-svelte'

    let form = useForm({
        mission: null,
    })

    function submit() {
        $form.post('/hub/missions');
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
<div class="flex justify-center items-center w-full" on:drop={handleDrop} on:dragover={handleDragOver}>
    <label for="dropzone-file" class="flex flex-col justify-center items-center w-full h-60 rounded-lg border-2 border-dashed cursor-pointer bg-gray-700 border-gray-600 hover:border-gray-500 hover:bg-gray-600">
        <div class="flex flex-col justify-center items-center pt-5 pb-6">
            <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
            {#if !$form.progress}
                <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
            {:else}
                <progress class="mb-3" value={$form.progress.percentage} max="100">{$form.progress.percentage}%</progress>
            {/if}
        </div>
        <form>
            <input id="dropzone-file" type="file" class="hidden" on:input={e => $form.mission = e.target.files[0]} on:change={submit}>
        </form>
    </label>
</div>
