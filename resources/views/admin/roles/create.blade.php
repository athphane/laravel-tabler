@extends('admin.roles.roles')

@section('title', 'Create Role')
@section('page-title', 'Create Role')

@section('content')
    {!! Form::open(['files' => true, 'route' => 'admin.roles.store']) !!}
    @include('admin.roles._form')
    {!! Form::close() !!}
@endsection
