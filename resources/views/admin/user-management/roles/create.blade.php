@extends('admin.roles.roles')

@section('title', 'Create Role')
@section('page-title', 'Create Role')

@section('content')
    {!! Form::open(['route' => 'admin.roles.store']) !!}
    @include('admin.user-management.roles._form')
    {!! Form::close() !!}
@endsection
