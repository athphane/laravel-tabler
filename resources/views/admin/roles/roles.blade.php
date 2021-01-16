@extends('layouts.admin')

@section('title', 'Roles')
@section('page-title', __('Roles'))

@if(isset($title))
    @section('page-subtitle', $title)
@endif

@section('model-actions')
    @include('admin.roles._actions')
@endsection
