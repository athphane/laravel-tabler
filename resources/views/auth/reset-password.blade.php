@extends('layouts.guest')

@section('content')
    {!! Form::open(['route' => 'password.update', 'autocomplete' => 'off']) !!}
    <div class="card card-md">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Reset your password') }}</h2>

            @component('auth.components.session-status', [
                'status' => session('status')
            ])
            @endcomponent

            @component('auth.components.error-list', [
                'errors' => $errors
            ])
            @endcomponent

            {{-- Password reset token --}}
            {!! Form::hidden('token', $request->route('token')) !!}

            <div class="form-group mb-3 mt-4">
                    <label class="form-label" for="email">
                        {{ __('Email Address') }}
                    </label>
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => true]) !!}
            </div>

            <div class="form-group mb-2">
                <label class="form-label">
                    {{ __('Password') }}
                </label>
                {!! Form::password('password', ['class' => 'form-control', 'required' => true]) !!}
            </div>

            <div class="form-group mb-2">
                <label class="form-label">
                    {{ __('Confirm Password') }}
                </label>
                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) !!}
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="icon fa fa-email"></i> {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
