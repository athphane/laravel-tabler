<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}
        @hasSection('title')
            | @yield('title', 'Admin Dashboard')
        @endif
    </title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;500;600;700&display=swap">

    <!-- CSS files -->
    <link href="{{ asset(mix('css/tabler-flags.css')) }}" rel="stylesheet"/>
    <link href="{{ asset(mix('css/tabler-payments.css')) }}" rel="stylesheet"/>
    <link href="{{ asset(mix('css/font-awesome.css')) }}" rel="stylesheet"/>

    @stack('vendor-styles')

    <link href="{{ asset(mix('css/admin.css')) }}" rel="stylesheet"/>

    @stack('styles')
</head>
