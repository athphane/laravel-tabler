@extends('admin.users.users')

@section('content')
    @if($users->isNotEmpty() || \App\Models\User::exists())
        {!! Form::open(['route' =>'admin.users.index', 'method' => 'GET', 'id' => 'filter']) !!}
        @include('admin.users._filter')
        {!! Form::close() !!}

        @include('admin.users._table')
    @else
        @component('admin.components.no-items', [
            'icon' => 'fa-users',
            'create_action' => route('admin.users.create'),
            'model_type' => __('users'),
            'model' => App\Models\User::class,
        ])
        @endcomponent
    @endif
@endsection
