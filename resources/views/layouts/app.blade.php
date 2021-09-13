<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    <link rel="stylesheet" href="{{ asset('vendor/avored/css/app.css') }}"></link>
    <script defer src="{{ asset('vendor/avored/js/app.js')  }}"></script>
</head>
<body>

    <div class="flex h-full">
		@include('avored::partials.sidebar')

		<div class="w-full">
           @include('avored::partials.header')
            @yield('content')
        </div>
    </div>
    
</body>
</html>