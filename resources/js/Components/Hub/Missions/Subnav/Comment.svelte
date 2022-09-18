<script lang="ts">
    export let comment
</script>

<div class="text-gray-200 py-4 flex">
    <img class="rounded-full h-8 w-8 mr-2 mt-1" src={comment.user.avatar} alt=""/>
    <div>
        <div class="bg-gray-700 rounded-3xl px-4 py-2">
            <div class="font-semibold text-sm leading-relaxed">{comment.user.username}</div>
            <div class="text-normal leading-snug md:leading-normal">{comment.text}</div>
        </div>
        <div class="text-sm ml-4 mt-0.5 text-gray-400">14 w</div>
    </div>
</div>
