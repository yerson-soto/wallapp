<form action="" class="row add-comment-form">
    <input type="hidden" name="post_id" value="{{ $post->id }}" class="post-id">
    <textarea
        name="content"
        placeholder="{{ __('Agrega un comentario') }}"
        class="border-0 d-block w-100 height-sm col-9 comment-content"
    ></textarea>
    <button
        type="submit"
        class="button-primary col-3 font-sm add-comment-btn"

    >
        <img src="{{ asset('img/go.svg') }}" alt="">
        <span class="d-inline">{{ __('Publicar') }}</span>
    </button>
</form>
