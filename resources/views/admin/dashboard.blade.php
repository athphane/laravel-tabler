@extends('layouts.admin')

@section('page-title')
    {{ __('Dashboard') }}
@endsection

@section('page-subtitle')
    {{ __('Welcome to the control panel.') }}
@endsection

@section('top-search')
    <div class="ms-md-auto ps-md-4 py-2 py-md-0 me-md-4 order-first order-md-last flex-grow-1">
        <form action="." method="get">
            <div class="input-icon">
                            <span class="input-icon-addon">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="10" cy="10" r="7"></circle><line x1="21" y1="21" x2="15" y2="15"></line></svg>
                            </span>
                <input type="text" class="form-control form-control-light" placeholder="Search…" aria-label="Search in website">
            </div>
        </form>
    </div>
@endsection

@section('content')
    {{ __('Successfully Blade-fied') }}
@endsection
