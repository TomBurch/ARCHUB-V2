<script lang="ts">
    import { useForm } from "@inertiajs/inertia-svelte";

    export let mission;

    let form = useForm({
        media: null,
    });

    function submit() {
        $form.post(`/hub/missions/${mission.id}/media`);
    }

    function handleDrop(event) {
        event.preventDefault();
        event.stopPropagation();
        $form.media = event.dataTransfer.files[0];
        submit();
    }

    function handleDragOver(event) {
        event.preventDefault();
        if (event.dataTransfer) {
            event.dataTransfer.dropEffect = "copy";
        }
    }
</script>

<!-- Adapted from https://flowbite.com/docs/forms/file-input/#dropzone -->
<div class="flex" on:drop={handleDrop} on:dragover={handleDragOver}>
    <label
        for="dropzone-file"
        class="flex h-60 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-600 bg-gray-700 hover:border-gray-500 hover:bg-gray-600"
    >
        <div class="flex flex-col items-center justify-center pt-5 pb-6">
            <svg
                aria-hidden="true"
                class="mb-3 h-10 w-10 text-gray-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                ><path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                /></svg
            >
            {#if Object.keys($form.errors).length > 0}
                {#each Object.entries($form.errors) as [form, error]}
                    <p class="mb-2 text-center text-sm font-semibold text-red-500">
                        {error}
                    </p>
                {/each}
            {:else if !$form.progress}
                <p class="mb-2 text-center text-sm text-gray-400">
                    <span class="font-semibold">Click to upload</span> or drag and drop
                </p>
            {:else}
                <progress class="mb-3" value={$form.progress.percentage} max="100">
                    {$form.progress.percentage}%
                </progress>
            {/if}
        </div>
        <form>
            <input
                id="dropzone-file"
                type="file"
                class="hidden"
                on:input={(e) => ($form.media = e.target.files[0])}
                on:change={submit}
            />
        </form>
    </label>
</div>
