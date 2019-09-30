@extends('layouts.app')

@section('sidebar')
    <aside class="col-md-4 py-5 bground-primary">
        <div class="row justify-content-center mb-5">
            @component('includes.message')
                {{ __('Con una foto de perfil estas mejor identificado y tus amigos te pueden encontrarte facilmente') }}
            @endcomponent
        </div>
        <div class="profile-img">
            <form action="{{ route('image.update') }}" enctype="multipart/form-data" method="POST" id="avatarForm">
                @csrf
                <label for="image" class="cursor-pointer row justify-content-center">
                    <div class="col-12 d-flex justify-content-center">
                       <img
                            src="{{ route('image.show', Auth::user()->image) }}"
                            alt="Avatar"
                            class="rounded-circle avatar"
                        >
                    </div>

                    <div class="col-5 d-block button-primary mt-4 select-avatar">
                        {{ __('Añade una Foto') }}
                    </div>
                </label>
                <input type="file" name="image" id="image" class="d-none">
            </form>
        </div>

    </aside>
@endsection

@section('content')
    <main class="col-md-7 offset-md-5 py-5">
       <div class="row">
            <div class="col-md-9">
                <p class="h2 font-weight-lighter mb-4 text-center text-md-left">{{ __('Actualiza los datos de tu cuenta') }}</p>

                <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <fieldset class="shadow-sm mb-5">
                        <legend>{{ __('Información personal') }}</legend>

                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="name" class="text-muted font-weight-lighter">{{ __('Tu nombre') }}</label>
                                <input
                                    type="text"
                                    class="form-control shadow-sm mb-2 @error('name') is-invalid @enderror"
                                    value="{{ (old('name') ? old('name') : Auth::user()->name) }}"
                                    id="name"
                                    name="name"
                                    autocomplete="name"

                                >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="surname" class="text-muted font-weight-lighter">{{ __('Tu apellido') }}</label>
                                <input
                                    type="text"
                                    class="form-control shadow-sm mb-2 @error('surname') is-invalid @enderror"
                                    value="{{ (old('surname') ? old('surname') : Auth::user()->surname) }}"
                                    id="surname"
                                    name="surname"
                                    autocomplete="surname"

                                >

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <!--end-fieldset-->

                    <fieldset class="shadow-sm mb-5">
                        <legend>{{ __('Información de la cuenta') }}</legend>

                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="role" class="text-muted font-weight-lighter">{{ __('Tipo de cuenta') }}</label>
                                <input
                                    type="text"
                                    class="form-control shadow-sm mb-2 text-muted @error('role') is-invalid @enderror"
                                    value="{{ (Auth::user()->role == 'user') ? __('Usuario') : __('Administrador')}}"
                                    id="role"
                                    name="role"
                                    autocomplete="role"
                                    disabled
                                >
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="email" class="text-muted font-weight-lighter">{{ __('Tu correo eléctronico') }}</label>
                                <input
                                    type="email"
                                    class="form-control shadow-sm mb-2 @error('email') is-invalid @enderror"
                                    value="{{ (old('email') ? old('email') : Auth::user()->email) }}"
                                    id="email"
                                    name="email"
                                    autocomplete="email"

                                >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="username" class="text-muted font-weight-lighter">{{ __('Tu nombre de usuario') }}</label>
                                <input
                                    type="text"
                                    class="form-control shadow-sm mb-2 @error('username') is-invalid @enderror"
                                    value="{{ (old('username') ? old('username') : Auth::user()->username) }}"
                                    id="username"
                                    name="username"
                                    autocomplete="username"

                                >

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <!--end-fieldset-->

                    <fieldset class="shadow-sm mb-5">
                        <legend>{{ __('Contraseña') }}</legend>

                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="current_password" class="text-muted font-weight-lighter">{{ __('Contraseña actual') }}</label>
                                <input
                                    type="password"
                                    class="form-control shadow-sm mb-2 @error('current_password') is-invalid @enderror"
                                    id="current_password"
                                    value="{{ old('current_password') }}"
                                    name="current_password"
                                    autocomplete="current_password"

                                >

                                @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="password" class="text-muted font-weight-lighter">{{ __('Nueva contraseña') }}</label>
                                <input
                                    type="password"
                                    class="form-control shadow-sm mb-2 @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    autocomplete="password"

                                >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 px-4">
                                <label for="password_confirmation" class="text-muted font-weight-lighter">{{ __('Confirmar nueva contraseña') }}</label>
                                <input
                                    type="password"
                                    class="form-control shadow-sm mb-2 @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    autocomplete="password_confirmation"

                                >

                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </fieldset>
                    <!--end-fieldset-->

                    <div class="form-group row">
                        <div class="col-12 d-flex justify-content-end">
                            <button
                                type="submit"
                                class="btn btn-outline-success rounded-0 py-2 px-4"
                            >
                                {{ __('Guardar Todo') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
       </div>

       @if($errors->any())
        @component('includes.alert')
                @slot('type', 'danger')
                {{ __('Completa los campos correctamente') }}
            @endcomponent
        @endif

        @if(session('success'))
        @component('includes.alert')
                @slot('type', 'success')
                {{ session('success') }}
            @endcomponent
        @endif
    </main>
@endsection


