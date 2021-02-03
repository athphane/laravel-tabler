@extends('admin.roles.roles')

@section('title', 'Edit Role')
@section('page-title', 'Edit Role')

@section('content')
    {!! Form::model($role, ['method' => 'PATCH', 'route' => ['admin.roles.update', $role]]) !!}
    @include('admin.user-management.roles._form')
    {!! Form::close() !!}
@endsection
