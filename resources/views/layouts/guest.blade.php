<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('admin.partials.head')

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center py-4">
        <div class="container-tight py-6">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}"><img src="{{ asset('static/logo.svg') }}" height="36" alt=""></a>
            </div>

            @section('content')
            @show
        </div>
    </div>
    @include('admin.partials.footer')
</body>
</html>
