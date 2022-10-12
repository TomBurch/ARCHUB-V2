<script lang="ts">
    import { onMount } from "svelte";
    import { Inertia } from "@inertiajs/inertia";
    import { page, useForm } from "@inertiajs/inertia-svelte";
    import Comment from "./Comment.svelte";

    export let mission;
    export let comments;
    export let type;

    let editing = null;

    let form = useForm({
        text: null,
        published: false,
    });

    function submit() {
        if (editing) {
            $form.published = false;
            $form.put(`/hub/missions/${mission.id}/${type}/${editing.id}`, {
                onSuccess: () => {
                    editing = null;
                    $form.reset();
                },
            });
        } else {
            $form.published = true;
            $form.post(`/hub/missions/${mission.id}/${type}`, {
                onSuccess: () => $form.reset(),
            });
        }
    }

    function handleDelete(event) {
        Inertia.delete(`/hub/missions/${mission.id}/${type}/${event.detail.comment.id}`, {
            onBefore: () => confirm("Are you sure?"),
        });
    }

    function handleEdit(event) {
        editing = event.detail.comment;
        $form.text = editing.text;
    }

    function handleCancel() {
        editing = null;
        $form.reset();
    }

    function saveProgress() {
        if (!editing) {
            $form.published = false;
            $form.post(`/hub/missions/${mission.id}/${type}`, {
                preserveScroll: true,
            });
        }
    }

    let timer;
    const debounce = (e) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            saveProgress();
        }, 3000);
    };

    onMount(async () => {
        let inProgress = comments.find((comment) => comment.user_id == $page.props.auth.user.id && !comment.published);
        if (inProgress) {
            $form.text = inProgress.text;
        }
    });
</script>

<!-- Adapted from https://flowbite.com/docs/forms/textarea/#comment-box -->
<form on:submit|preventDefault={submit}>
    <div class="mb-4 w-full rounded-lg border border-gray-600 bg-gray-700">
        <div class="rounded-t-lg bg-gray-800 py-2 px-4">
            <textarea
                bind:value={$form.text}
                on:keyup={debounce}
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
                class="rounded-lg bg-blue-700 py-2.5 px-4 text-xs font-medium text-white hover:bg-blue-800"
            >
                {#if editing}
                    Save
                {:else}
                    Submit
                {/if}
            </button>
            {#if editing}
                <button
                    on:click|preventDefault={handleCancel}
                    disabled={$form.processing}
                    class="rounded-lg bg-blue-700 py-2.5 px-4 text-xs font-medium text-white hover:bg-blue-800"
                >
                    Cancel
                </button>
            {/if}
        </div>
    </div>
</form>

{#each comments as comment}
    {#if comment.published}
        <Comment {comment} on:delete={handleDelete} on:edit={handleEdit} />
    {/if}
{/each}
