@extends('layouts.app')

@section('content')
<main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-12">
                    <div class="row">
                        <div class="col-md-7 ">
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
                            </div><!--card-body-->
                        </div>

                        <div class="col-md-5 align-self-end ">
                            <div>
                                @if ($post->allComments)
                                    <section class="comments mt-2 mb-4">
                                        @foreach ($post->allComments as $comment)
                                            <div class="pl-2 ml-5 pr-4 mb-2 border-left ">
                                                <p class="m-0">
                                                    <span class="font-weight-bold">{{ $comment->user->username }}:</span>
                                                    <span>{{ $comment->content }}</span>
                                                </p>
                                                <span class="text-muted font-sm d-block">
                                                    {{ FormatTime::LongTimeFilter($comment->created_at) }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </section >
                                @endif
                            </div>

                            <div class="card-footer bg-transparent mt-1">
                                @include('post.inc.comment_form')
                            </div><!--card-footer-->
                        </div>
                    </div>


                </div><!--card-->

        </div><!--row-->

    </main>
@endsection
