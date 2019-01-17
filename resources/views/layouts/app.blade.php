<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LeadStore') }}</title>

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('vendor/avored-admin/css/app.css') }}" rel="stylesheet">

    @yield('css')
    @stack('styles')

    <script>
        window.Laravel = <?php
        echo json_encode([
            'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>

</head>

<body class="app">
<div>
    @include("avored-framework::layouts.left-nav")

    <div class="page-container">
        @include("avored-framework::layouts.nav")
        <main class='main-content bgc-grey-100'>
            <div id='mainContent'>
                @include("avored-framework::layouts.notifications")

                <div class="masonry-sizer col-md-6"></div>
                <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
                @yield('content')
            </div>
        </main>

        @include("avored-framework::layouts.footer")
    </div>
</div>

<script src="{{ url('vendor/avored-admin/js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
