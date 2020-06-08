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
        <avored-layout inline-template>
            <a-layout id="avored-admin-layout" style="min-height: 100vh">
                @include('avored::partials.sidebar')
                <a-layout>

                    @include('avored::partials.header')

                    @include('avored::partials.flash')
                    @include('avored::partials.breadcrumb')
                    
                    
                    <h1 class="ml-4 my-3 text-red-700 text-bold text-2xl">@yield('page_title')</h1>
                    
                    <a-layout-content class="mh-1 ph-1 pt-1 bg-white">
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
