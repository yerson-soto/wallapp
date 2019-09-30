@if ($post->comments)
    <section class="comments mt-1">
        @foreach ($post->comments as $comment)
            <div class="pl-2 ml-5 pr-4 mb-2 border-left font-sm">
                <p class="m-0">
                    <span class="font-weight-bold">{{ $comment->user->username }}:</span>
                    <span>{{ $comment->content }}</span>
                </p>
                <span class="text-muted font-sm d-block">
                    {{ FormatTime::LongTimeFilter($comment->created_at) }}
                </span>
            </div>
        @endforeach
    </section>
@endif
