<div class="mt-1 pr-3">
    <img
        src="{{ route('image.show', $post->user->image) }}"
        alt="Avatar"
        class="rounded-circle avatar-min"
    >
</div>
<div class="media-body">
    <p class="m-0">{{ $post->user->username }},
        <span class="ml-1 text-muted font-sm">
            {{ FormatTime::LongTimeFilter($post->created_at) }}
        </span>
    </p>
</div>
