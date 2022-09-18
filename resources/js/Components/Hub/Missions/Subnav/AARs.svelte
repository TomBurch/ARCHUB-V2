<script lang="ts">
    import { useForm } from '@inertiajs/inertia-svelte'
    import Comment from './Comment.svelte'

    export let mission

    let form = useForm({
        text: null,
    })

    function submit() {
        $form.post(`/hub/missions/${mission.id}/comments`, {
            onSuccess: () => $form.reset(),
        });
    }
</script>

<!-- Adapted from https://flowbite.com/docs/forms/textarea/#comment-box -->
<form on:submit|preventDefault={submit}>
   <div class="mb-4 w-full rounded-lg bg-gray-700 border border-gray-600">
       <div class="py-2 px-4 rounded-t-lg bg-gray-800">
           <textarea bind:value={$form.text} rows=4 class="px-0 w-full text-sm text-white border-0 bg-gray-800 focus:ring-0 placeholder-gray-400" placeholder="Write a comment..." required></textarea>
       </div>
       <div class="flex justify-between items-center py-2 px-3 border-t border-gray-600">
           <button type="submit" disabled={$form.processing} class="inline-flex items-center py-2.5 px-4 text-xs text-white font-medium rounded-lg bg-blue-700 hover:bg-blue-800">
               Submit
           </button>
       </div>
   </div>
</form>

{#each mission.comments.reverse() as comment}
    <Comment comment={comment}/>
{/each}
