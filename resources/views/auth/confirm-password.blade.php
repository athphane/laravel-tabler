@extends('layouts.guest')

@section('content')
    {!! Form::open(['route' => 'password.confirm']) !!}
    <div class="card card-md">
        <div class="card-body text-center">
            <div class="mb-4">
                <h2 class="card-title">{{ __('Account Locked') }}</h2>
                <p class="text-muted">{{ __('Please enter your password to continue') }}</p>
            </div>

            <div class="mb-4">
                <span class="avatar avatar-xl mb-3" style="background-image: url(./static/avatars/000m.jpg)"></span>
                <h3>{{ Auth::user()->name }}</h3>
            </div>

            @component('auth.components.error-list', [
                'errors' => $errors
            ])
            @endcomponent

            <div class="form-group mb-4">
                {!! Form::password('password', ['class' => 'form-control', 'required' => true, 'placeholder' => 'Password...']) !!}
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <rect x="5" y="11" width="14" height="10" rx="2"/>
                    <circle cx="12" cy="16" r="1"/>
                    <path d="M8 11v-5a4 4 0 0 1 8 0"/>
                </svg> {{ __('Unlock') }}
            </button>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="text-center text-muted mt-3">
        {!! Form::open(['route' => 'logout']) !!}
        <a class="text-muted" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                this.closest('form').submit();">
            {{ __('Sign me out instead') }}
        </a>
        {!! Form::close() !!}
    </div>
@endsection
