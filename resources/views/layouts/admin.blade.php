<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('admin.partials.head')
    <body class="antialiased">
        <div class="page">
            @include('admin.partials.header')

            @include('admin.partials.navigation')

            <section class="content">
                <div class="container-xl">
                    <!-- Page title -->
                    <div class="page-header d-print-none">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="page-title">@yield('page-title')</h2>
                                <small>@yield('page-subtitle')</small>
                            </div>
                        </div>
                    </div>

                    @foreach(session()->get('alerts',[]) as $alert)
                        <div class="alert alert-{{ $alert['type'] }}" role="alert">
                            <h4 class="alert-title">{{ $alert['title'] }}</h4>
                            <div class="text-muted">{{ $alert['text'] }}</div>
                        </div>
                    @endforeach

                    @section('content')
                    @show
                </div>
                @include('admin.partials.copyright')
            </section>
        </div>

    @include('admin.partials.footer')
    </body>
</html>
