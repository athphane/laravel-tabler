@extends('layouts.guest')

@section('content')
    {!! Form::open(['route' => 'admin.verification.send', 'autocomplete' => 'off']) !!}
    <div class="card card-md">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Please verify your email.') }}</h2>

            <p class="text-muted">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we already emailed you? If you didn\'t receive the email, we will gladly send you another. We\'ll send it to the one below.') }}
            </p>

            @if(session('status') == 'verification-link-sent')
                <p class="text-success">
                    {{ __('A new verification link has been sent to your registered email below.') }}
                </p>
            @endif

            <div class="mb-3 mt-4">
                <label class="form-label">
                    {{ __('Your Email Address') }}
                </label>
                <div class="form-control-plaintext">{{ Auth::user()->email }}</div>
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
        {!! Form::open(['route' => 'admin.logout']) !!}
            <a class="text-muted" href="{{ route('admin.logout') }}"
                     onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Sign me out instead') }}
            </a>
        {!! Form::close() !!}
    </div>
@endsection
