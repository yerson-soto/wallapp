@extends('layouts.app')

@section('content')
<div class="container position-center">
    <div class="row justify-content-center">
        <div class="col-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card">
                <div class="card-header bg-secondary text-white h5 text-center">{{ __('Regístrate') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row justify-content-center">

                            <div class="col-10">
                                <input id="name" type="text" placeholder="{{ __('Name') }}" class="form-control rounded-0 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-10">
                                <input type="text" id="surname" placeholder="{{ __('Lastname') }}" class="form-control rounded-0 @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname">

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                                <div class="col-10">
                                    <input id="username" type="text" placeholder="{{ __('Username') }}" class="form-control rounded-0 @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-10">
                                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-10">
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">
                            <div class="col-10">
                                <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}" class="form-control rounded-0" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-10 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-0">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
