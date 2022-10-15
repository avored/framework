<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    <link rel="stylesheet" href="{{ asset('vendor/avored/css/app.css') }}"></link>

    <livewire:styles />
    <livewire:scripts />
</head>
<body x-data="app">

    <div class="flex h-full" x-data="{ isSideBarOpen: true, showAlert : false, showAlertMessage:  ''}">
		@include('avored::partials.sidebar')

		<div class="w-full">
            @include('avored::partials.header')

            {!! Breadcrumb::render(Route::currentRouteName()) !!}
            {{ $slot }}
        </div>
    </div>
    
    <script src="{{ asset('vendor/avored/js/app.js')  }}"></script>
    @stack('scripts')
    <script>
        Alpine.start()
        document.addEventListener('alpine:init', () => {
            console.log('alpine init')
        })
    </script>
</body>
</html>
