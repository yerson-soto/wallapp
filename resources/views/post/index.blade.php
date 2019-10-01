@extends('layouts.app')


@section('content')
    <main class="container py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card mb-4">
                            {{-- add post form --}}
                            <div class="card-header bg-transparent">
                                <p class="card-title p-0 m-0 text-muted">{{ __('Comparte tu historia') }}</p>
                            </div>
                            <div class="card-body p-0">
                                <form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="media px-4 p-2">
                                        <div class="mt-1 pr-4">
                                            <img
                                                src="{{ route('image.show', Auth::user()->image) }}"
                                                alt="Avatar"
                                                class="rounded-circle avatar-min"
                                            >
                                        </div>
                                        <div class="media-body">
                                            <textarea
                                                name="history"
                                                class="border-0 d-block mb-2 w-100 height-md font-weight-lighter"
                                                autofocus
                                            ></textarea>
                                            @error('history')
                                                <span class="text-danger d-block pr-4" role="alert">
                                                    {{ 'No has escrito nada.'}}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="btn-group d-flex justify-content-end mx-4 py-3 border-top">
                                        @error('image')
                                            <span class="text-danger d-block pr-4" role="alert">
                                                {{ 'Sube una imagen válida.'}}
                                            </span>
                                        @enderror
                                        <label for="post_image" class="button-primary mb-0 mr-3 px-3 font-sm" id="post_image_btn">
                                            <img src="{{ asset('img/photo.svg') }}" alt="">
                                            <span>{{ __('Subir imagen') }}</span>
                                        </label>
                                        <input type="file" name="image" id="post_image" class="d-none">

                                        <button
                                            type="submit"
                                            class="button-primary px-3 font-sm"
                                        >
                                            <img src="{{ asset('img/go.svg') }}" alt="">
                                            <span>{{ __('Publicar') }}</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div><!--card-->

                        @foreach ($posts as $post)
                            <div class="card mb-4">
                                <div class="card-header p-0 bg-white border-bottom-0">
                                    {{-- post-header --}}
                                    <div class="media align-items-center px-4 py-2">
                                        @include('post.inc.post_header')
                                        {{-- dropdown post menu --}}
                                        <div class="options">
                                            @include('post.inc.dropdown')
                                        </div>
                                    </div><!--media-->
                                </div><!--card-header-->

                                <div class="card-body p-0 pb-2">
                                    @include('post.inc.post_body')
                                    @include('post.inc.post_comments')
                                </div><!--card-body-->

                                <div class="card-footer bg-transparent mt-1">
                                    @include('post.inc.comment_form')
                                </div><!--card-footer-->
                            </div><!--card-->
                        @endforeach

                    </div>
                </div><!--row-->
            </div><!--col-->

            <div class="col-md-4">
                <aside>
                    <h4 class="font-weight-lighter border-bottom pb-2 mb-3 h5">{{ __('Personas') }}</h4>
                    <ul class="p-0">
                        @foreach ($users as $user)
                            <li class="d-flex justify-content-between align-items-center mb-3">
                                <a class="link" href="{{ route('profile', $user->username) }}">
                                    <img src="{{ route('image.show', $user->image) }}" alt="" class="rounded-circle avatar-sm">
                                    <p class="m-0 d-inline px-2 mr-4">{{ $user->username }}</p>
                                </a>
                                <span class="button-primary font-sm px-2 rounded-0">
                                    {{ __('Seguir') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                        <a href="{{ route('users') }}" class="button-primary link d-block py-2 mt-4">
                            {{ __('Ver todos') }}
                        </a>
                </aside>
            </div>
        </div><!--row-->
    </main>
@endsection



