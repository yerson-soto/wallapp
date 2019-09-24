@extends('layouts.app')

@section('content')
<div class="container position-center mid">
    <div class="row justify-content-center">
        <div class="col-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card">
                <div class="card-header bg-secondary text-white h4 text-center">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row justify-content-center">

                            <div class="col-10">
                                <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control rounded-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row justify-content-center">

                            <div class="col-10">
                                <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control rounded-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row justify-content-center">
                            <div class="col-10">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-outline-secondary">
                                        <input type="checkbox" {{ old('remember') ? 'checked' : '' }} autocomplete="off" name="remember" id="remember"> {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="form-group row justify-content-center mb-0">
                            <div class="col-10 flex-column d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-0 mb-2">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
