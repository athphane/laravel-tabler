@extends('admin.user-management.user-management')

@section('title', 'Users')
@section('page-title', __('Users'))

@if(isset($title))
    @section('page-subtitle', $title)
@endif

@section('model-actions')
    @include('admin.user-management.users._actions')
@endsection
