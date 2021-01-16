@extends('admin.roles.roles')

@section('content')
    @if($roles->isNotEmpty() || \App\Models\User::exists())
        {!! Form::open(['route' =>'admin.roles.index', 'method' => 'GET', 'id' => 'filter']) !!}
        @include('admin.roles._filter')
        {!! Form::close() !!}

        @include('admin.roles._table')
    @else
        @component('admin.components.no-items', [
            'icon' => 'fa-roles',
            'create_action' => route('admin.roles.create'),
            'model_type' => __('roles'),
            'model' => App\Models\User::class,
        ])
        @endcomponent
    @endif
@endsection
