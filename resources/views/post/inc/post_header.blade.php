<div class="mt-1 pr-3">
    <a href="{{ route('profile', $post->user->username) }}" class="link">
        <img
            src="{{ route('image.show', $post->user->image) }}"
            alt="Avatar"
            class="rounded-circle avatar-min"
        >
    </a>
</div>
<div class="media-body">
    <a href="{{ route('profile', $post->user->username) }}" class="m-0 link">{{ $post->user->username }},
        <span class="ml-1 text-muted font-sm">
            {{ FormatTime::LongTimeFilter($post->created_at) }}
        </span>
    </a>
</div>
