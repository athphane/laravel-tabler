@extends('layouts.guest')

@section('content')
    {!! Form::open(['route' => 'login', 'autocomplete' => 'off']) !!}
    <div class="card card-md">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Login to your account') }}</h2>

            @component('auth.components.session-status', [
                'status' => session('status')
            ])
            @endcomponent

            @component('auth.components.error-list', [
                'errors' => $errors
            ])
            @endcomponent

            <div class="mb-3">
                {!! Form::label('email', __('Email Address'), ['class' => 'form-label']) !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => true]) !!}
            </div>

            <div class="mb-3">
                <label class="form-label">
                    {{ __('Password') }}
                    <span class="form-label-description">
                        <a href="{{ route('password.request') }}">{{ __('Forgot password?') }}</a>
                    </span>
                </label>
                <div class="input-group input-group-flat">
                    {!! Form::password('password', ['class' => 'form-control', 'required' => true]) !!}
                </div>
            </div>

            <div class="mb-3">
                <label class="form-check" for="remember_me">
                    {!! Form::checkbox('remember_me', 1, null, ['class' => 'form-check-input']) !!}
                    <span class="form-check-label">{{ __('Remember me on this device') }}</span>
                </label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{ __('Sign in') }}</button>
            </div>
        </div>

        <div class="hr-text">or</div>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="#" class="btn btn-white w-100">
                        <i class="icon fa fa-github text-github"></i> {{ __('Login with Github') }}
                    </a>
                </div>

                <div class="col">
                    <a href="#" class="btn btn-white w-100">
                        <i class="icon fa fa-twitter text-twitter"></i>
                        {{ __('Login with Twitter') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="text-center text-muted mt-3">
        {{ __('Don\'t have account yet?') }} <a href="{{ route('register') }}" tabindex="-1">{{ __('Sign up') }}</a>
    </div>
@endsection
