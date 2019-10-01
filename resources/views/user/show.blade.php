@extends('layouts.app')

@section('content')
    <main class="container py-5">
        <div class="row justify-content-center align-items-center border-bottom pb-4">
            <div class="col-md-4 d-flex justify-content-center">
                <img
                    src="{{ route('image.show', $user->image) }}"
                    alt="{{ $user->name . ' ' . $user->surname }}"
                    class="avatar rounded-circle"
                >
            </div>
            <div class="col-md-6 d-flex d-md-block flex-column align-items-center mt-4 mt-md-0">
                <p class="h4">{{ $user->name . ' ' . $user->surname }}</p>
                <p class="h6">
                    {{ $user->username }} |
                    <span class="font-sm">Se unio {{ FormatTime::LongTimeFilter($user->created_at) }}</span>
                </p>
                <ul class="p-0 list-style-none mt-3 font-lg">
                    <li class="d-inline mr-3">
                        <span class="font-weight-bold">0</span>
                        seguidores
                    </li>
                    <li class="d-inline mr-3">
                        <span class="font-weight-bold">{{ count($user->posts) }}</span>
                        publicaciones
                    </li>
                    <li class="d-inline">
                        <span class="font-weight-bold">{{ count($user->comments) }}</span>
                        comentarios
                    </li>
                </ul>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                @php
                    $posts = $user->posts;
                @endphp

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
    </main>
@endsection
