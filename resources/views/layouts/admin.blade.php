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
                                <h2 class="page-title">
                                    Empty page
                                </h2>
                            </div>
                        </div>
                    </div>

                    @section('content')
                    @show
                </div>
                @include('admin.partials.copyright')
            </section>
        </div>

    @include('admin.partials.footer')
    </body>
</html>
