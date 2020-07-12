<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    <!-- Styles -->
   
    @if(file_exists(public_path('mix-manifest.json')))
        <link href="{{ mix('vendor/avored/css/app.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('vendor/avored/css/app.css') }}" rel="stylesheet">
    @endif
</head>

<body>
    <div id="app">
        <avored-layout inline-template>
            <a-layout id="avored-admin-layout" style="min-height: 100vh">
                @include('avored::partials.sidebar')
                <div class="w-full z-10">
                    @include('avored::partials.header')
                    @include('avored::partials.flash')
                    @include('avored::partials.breadcrumb')

                    <h1 class="mx-4 my-3">
                        @yield('page_title')
                    </h1>
                    <div class="rounded p-5 mx-3 my-3 bg-white">
                        @yield('content')
                    </div>

                    @include('avored::partials.footer')
                </div>

            </a-layout>
        </avored-layout>
    </div>
    @if(file_exists(public_path('mix-manifest.json')))
        <script src="{{ mix('vendor/avored/js/app.js') }}"></script>
    @else
        <script src="{{ asset('vendor/avored/js/app.js') }}"></script>
    @endif
    
    @stack('scripts')
</body>

</html>
