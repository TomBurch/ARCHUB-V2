<script lang="ts">
    import SvelteMarkdown from "svelte-markdown";
    export let comment;

    let options = {
        gfm: true,
        breaks: true,
    };
</script>

<div class="flex py-4 text-gray-200">
    <img class="mr-2 mt-1 h-8 w-8 rounded-full" src={comment.user.avatar} alt="" />
    <div>
        <div class="rounded-3xl bg-gray-700 px-4 py-2">
            <div class="text-sm font-semibold leading-relaxed">
                {comment.user.username}
            </div>
            <div class="text-normal leading-snug md:leading-normal">
                {comment.text}
            </div>
            <SvelteMarkdown source={comment.text} {options} />
        </div>
        <div class="ml-4 mt-0.5 text-sm text-gray-400">14 w</div>
    </div>
</div>
