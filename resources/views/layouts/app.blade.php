<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    <!-- Styles -->
   
    {!! Asset::renderCSS() !!}
    @push('styles')

</head>

<body>
    <div id="app">
        <avored-alert></avored-alert>
        <avored-confirm></avored-confirm>
        
        <avored-layout inline-template>
            
            <div class="flex items-start">
                <div :class="sidebar ? 'w-16 z-0 transition sidebar-collapsed duration-500' : 'w-64'">
                    @include('avored::partials.sidebar')
                </div>
                <div class="w-full">
                    <div class="w-full">
                    @include('avored::partials.header')
                    @include('avored::partials.flash')
                    @include('avored::partials.breadcrumb')

                    <h1 class="mx-4 px-4 my-3">
                        @yield('page_title')
                    </h1>
                    <div class="rounded p-5 mx-3 my-3 bg-white">
                        <router-view></router-view>
                        @yield('content')
                    </div>

                    @include('avored::partials.footer')
                    </div>
                </div>

            </div>
        </avored-layout>
    </div>
    @if(env('APP_ENV') === 'local' && file_exists(public_path('mix-manifest.json')))
        <script src="{{ mix('vendor/avored/js/avored.js') }}"></script>
        @stack('scripts')
        <script src="{{ mix('vendor/avored/js/app.js') }}"></script>
    @else
        <script src="{{ route('admin.script', 'avored.avored.js') }}"></script>
        @stack('scripts')
        <script src="{{ route('admin.script', 'avored.app.js') }}"></script>
    @endif
    
</body>

</html>
