@extends('admin.users.users')

@section('title', 'Create User')
@section('page-title', 'Create User')

@section('content')
    {!! Form::open(['files' => true, 'route' => 'admin.users.store']) !!}
    @include('admin.users._form')
    {!! Form::close() !!}
@endsection
