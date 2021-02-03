@extends('layouts.admin')

@section('title', 'User Management')
@section('page-title', __('User Management'))

@if(isset($title))
    @section('page-subtitle', $title)
@endif

@section('aside')
    @php
        $data = [
            [
                'heading' => __("Modules"),
                'links' => [
                    [
                        'name' => __('Users'),
                        'url' => route('admin.users.index'),
                        'permission' => 'index_users',
                    ],
                    [
                        'name' => __('Roles'),
                        'url' => route('admin.roles.index'),
                        'permission' => 'index_roles',
                    ],
                ]
            ]
    ];
    @endphp
    @component('admin.components.new-aside-links', ['data' => $data])
    @endComponent
@endsection
