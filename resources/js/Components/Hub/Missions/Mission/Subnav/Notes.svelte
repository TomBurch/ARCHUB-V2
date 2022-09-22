<script lang="ts">
    import { useForm } from "@inertiajs/inertia-svelte";
    import Comment from "./Comment.svelte";

    export let mission;

    let form = useForm({
        text: null,
    });

    function submit() {
        $form.post(`/hub/missions/${mission.id}/notes`, {
            onSuccess: () => $form.reset(),
        });
    }
</script>

<!-- Adapted from https://flowbite.com/docs/forms/textarea/#comment-box -->
<form on:submit|preventDefault={submit}>
    <div class="mb-4 w-full rounded-lg border border-gray-600 bg-gray-700">
        <div class="rounded-t-lg bg-gray-800 py-2 px-4">
            <textarea
                bind:value={$form.text}
                rows="4"
                class="w-full border-0 bg-gray-800 px-0 text-sm text-white placeholder-gray-400 focus:ring-0"
                placeholder="Write a comment..."
                required
            />
        </div>
        <div class="flex items-center justify-between border-t border-gray-600 py-2 px-3">
            <button
                type="submit"
                disabled={$form.processing}
                class="inline-flex items-center rounded-lg bg-blue-700 py-2.5 px-4 text-xs font-medium text-white hover:bg-blue-800"
            >
                Submit
            </button>
        </div>
    </div>
</form>

{#each mission.notes.reverse() as note}
    <Comment comment={note} />
{/each}
