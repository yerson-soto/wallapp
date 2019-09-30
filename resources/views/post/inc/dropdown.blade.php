<div class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item font-sm" href="{{ route('post.show', $post) }}">
                {{ __('Ver detalles') }}
            </a>

            @if ($post->user->id == Auth::user()->id)
                <div class="dropdown-item">
                    <form action="{{ route('post.delete', $post) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button
                            type="submit"
                            class="border-0 bg-transparent p-0 font-sm"
                        >
                            {{ __('Eliminar publicacion') }}
                        </button>
                    </form>
                </div>
            @else
                <a class="dropdown-item font-sm" href="">
                    {{ __('Seguir') }}
                </a>
            @endif
        </div>
    </div>
