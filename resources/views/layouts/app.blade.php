<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    <!-- Styles -->
    <link href="{{ asset('avored-admin/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <avored-layout inline-template >
            <a-layout id="avored-admin-layout" style="min-height: 100vh">
                @include('avored::partials.sidebar')
                <a-layout>
               
                    @include('avored::partials.header')
                    <a-layout-content :style="{ margin: '24px 16px', padding: '24px', background: '#fff', minHeight: '1280px' }">
                        @yield('content')
                    </a-layout-content>

                    @include('avored::partials.footer')
                </a-layout>
           
            </a-layout>
        </avored-layout>
    </div>
    <script src="{{ asset('avored-admin/js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
