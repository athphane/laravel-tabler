@extends('admin.users.users')

@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
    {!! Form::model($user, ['files' => true, 'method' => 'PATCH', 'route' => ['admin.users.update', $user]]) !!}
    @include('admin.users._form')
    {!! Form::close() !!}
@endsection
