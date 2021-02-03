@extends('admin.user-management.user-management')

@section('title', 'Roles')
@section('page-title', __('Roles'))

@if(isset($title))
    @section('page-subtitle', $title)
@endif

@section('model-actions')
    @include('admin.user-management.roles._actions')
@endsection
