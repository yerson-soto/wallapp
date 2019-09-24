<h1>Lista de publicaciones</h1>

@foreach ($posts as $post)
    <h2>Usuario: {{ $post->user->username }}</h2>
    <p>Imagen: {{ $post->image }}</p>
    <p>Contenido: {{ $post->history }}</p>
    <blockquote>
        Comentarios:
        @foreach($post->comments as $comment)
            <p>{{ $comment->content }}</p>
        @endforeach
    </blockquote>
@endforeach
