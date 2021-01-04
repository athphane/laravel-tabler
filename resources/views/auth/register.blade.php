@extends('layouts.guest')

@section('content')
    {!! Form::open(['route' => 'admin.register', 'autocomplete' => 'off']) !!}
    <div class="card card-md">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Create new account') }}</h2>

            @component('auth.components.error-list', [
                'errors' => $errors
            ])
            @endcomponent

            <div class="form-group mb-3">
                {!! Form::label('name', __('Name')) !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'John Appleseed']) !!}
            </div>

            <div class="form-group mb-3">
                {!! Form::label('email', __('Email Address'), ['class' => 'form-label']) !!}
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'john.appleseed@gmail.com']) !!}
            </div>

            <div class="form-group mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                {!! Form::password('password', ['class' => 'form-control', 'required' => true]) !!}
            </div>

            <div class="form-group mb-2">
                <label class="form-label">
                    {{ __('Confirm Password') }}
                </label>
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) !!}
            </div>

            <div class="form-group mb-3">
                <label class="form-check" for="remember_me">
                    {!! Form::checkbox('agree_tos', 1, null, ['class' => 'form-check-input']) !!}
                    <span class="form-check-label">I agree to the <a href="#" tabindex="-1">terms and conditions</a>.</span>
                </label>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{ __('Create new account') }}</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="text-center text-muted mt-3">
        {{ __('Already have account?') }} <a href="{{ route('admin.login') }}" tabindex="-1">{{ __('Sign in') }}</a>
    </div>
@endsection
