@extends('admin.user-management.user-management')

@section('title', 'User Management')
@section('page-title', __('User Management'))

@if(isset($title))
    @section('page-subtitle', $title)
@endif

@section('content')
        @foreach($stats->chunk(2) as $stats)
    <div class="row mb-3">
            @foreach($stats as $stat)
                <div class="col-md-6">
                    @component('admin.components.widgets.simple-stats', ['stat' => $stat])
                    @endcomponent
                </div>
            @endforeach
    </div>
        @endforeach
@endsection
