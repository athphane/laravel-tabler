@extends('layouts.admin')

@section('title', 'Users')
@section('page-title', __('Users'))

@if(isset($title))
    @section('page-subtitle', $title)
@endif

@section('model-actions')
    @include('admin.users._actions')
@endsection
