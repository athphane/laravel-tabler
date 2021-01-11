@extends('layouts.admin')

@section('title', 'Bulk SMS Sender')

@section('page-title')
    {{ __('Bulk SMS Sender') }}
@endsection

@section('page-subtitle')
    {{ __('Send messages to your enemies... AS YOUR ENEMY!') }}
@endsection

@section('content')
    {!! Form::open(['route' => 'admin.bulk-sms.send']) !!}
    @include('admin.bulk-sms._form')
    {!! Form::close() !!}
@endsection
