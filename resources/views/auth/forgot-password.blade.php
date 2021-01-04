@extends('layouts.guest')

@section('content')
    {!! Form::open(['route' => 'password.email', 'autocomplete' => 'off']) !!}
    <div class="card card-md">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Forgot your password?') }}</h2>
            <p class="text-muted">{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ') }}</p>

            @component('auth.components.session-status', [
                'status' => session('status')
            ])
            @endcomponent

            <div class="mb-3 mt-4">
                {!! Form::label('email', __('Email Address'), ['class' => 'form-label'])!!}
                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="icon fa fa-email"></i> {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="text-center text-muted mt-3">
        Forget it, <a href="{{ route('login') }}">send me back</a> to the sign in screen.
    </div>
@endsection
