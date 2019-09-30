@if (($post->image))
<a href="{{ route('post.show', $post) }}">
    <img src="{{ route('post.image', $post->image)}}" alt="" class="img-fluid">
</a>
@endif
<section class="py-2 px-4">
    <a href="" class="link mr-3 vote" data-id="{{ $post->id }}">
        {{-- if the authenticated user matches the user who gave like mark vote --}}
        @php $vote = 'downvote' @endphp
        @foreach ($post->likes as $like)
            @if ($like->user_id == Auth::user()->id)
                @php $vote = 'upvote' @endphp
            @endif
        @endforeach

        <img src="{{ asset("img/$vote.svg") }}" alt="" width="20" class="mr-1">
        <span class="like-count">{{ count($post->likes) }}</span>
    </a>
    <div class="d-inline">
        <img src="{{ asset('img/comment.svg') }}" alt="" width="20" class="mr-1">
        <span class="comments-count">{{ count($post->comments) }}</span>
    </div>
</section>
@if ($post->history)
    <p class="m-0 px-4 pt-1  pb-2 font-md">
        <span class="font-weight-bold mr-1">{{ $post->user->username }}:</span>
        {{ $post->history }}
    </p>
@endif
