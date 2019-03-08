<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AvoRed Ecommerce') }}</title>

    <!-- Styles -->
    <link href="{{ url('vendor/avored-admin/css/app.css') }}" rel="stylesheet"> 
    
    @yield('css')

    <script>
        window.Laravel = <?php
        echo json_encode([
                'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>    

</head>

<body>
    <div id="app">
      <div :class="{ 'is-collapsed': toggleSideBarData, 'app' : true }">
      @include("avored-framework::layouts.left-nav")
      <div class="page-container">
        @include("avored-framework::layouts.nav")
        <main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            @include("avored-framework::layouts.notifications")
            <div class="masonry-sizer col-md-6"></div>
              <h4 class="c-grey-900 mT-10 mB-30">
                @yield('page-header')
              </h4>
              @yield('content')
          </div>
        </main>

        @include("avored-framework::layouts.footer")
      </div>
    </div>
  </div>

  @if (true || request()->get('with') == 'all') 
  <script src="{{ url('vendor/avored-admin/js/app.js') }}"></script>
  <script src="{{ url('vendor/avored-admin/js/vue.js') }}"></script>
  @else
  <script src="{{ url('vendor/avored-admin/js/vue.js') }}"></script>
  @endif
  @stack('scripts')
</body>
</html>
