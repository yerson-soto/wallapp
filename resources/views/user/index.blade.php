@extends('layouts.app')

@section('content')
    <main class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-md-6">
                <form action="{{ route('users') }}" method="POST" class="form-group" id="find-people-form">
                    @csrf
                    <input
                        type="text"
                        name="search"
                        placeholder="Buscar personas"
                        class="form-control shadow-sm p-3"
                        value="{{ ($search) ? $search : '' }}"
                        autofocus

                        oninput="document.querySelector('#find-people-form').submit();"

                    >
                </form>
            </div>
        </div>
        @foreach ($users as $user)
            <div class="row justify-content-center align-items-center border-bottom pb-4 mb-5">
                <div class="col-md-3 d-flex justify-content-center">
                    <a href="{{ route('profile', $user->username) }}" class="link">
                        <img
                            src="{{ route('image.show', $user->image) }}"
                            alt="{{ $user->name . ' ' . $user->surname }}"
                            class="avatar rounded-circle"
                        >
                    </a>
                </div>
                <div class="col-md-5 d-flex d-md-block flex-column align-items-center mt-4 mt-md-0">
                    <a href="{{ route('profile', $user->username) }}" class="link">
                        <p class="h4">{{ '@'.$user->username }}</p>
                    </a>
                    <p class="h6">
                        {{ $user->name . ' ' . $user->surname }} |
                        <span class="font-sm">Se unio {{ FormatTime::LongTimeFilter($user->created_at) }}</span>
                    </p>
                </div>
            </div>
        @endforeach
    </main>
@endsection
