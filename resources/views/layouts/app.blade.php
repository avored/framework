<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AvoRed Ecommerce') }}</title>

    <!-- Styles -->
    <link href="{{ mix('vendor/avored-admin/css/app.css') }}" rel="stylesheet"> 
    
    @yield('css')

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
          <div class="masonry-sizer col-md-6"></div>
            <div class="row">
                <div class="col-12">
                  @if(session()->has('notificationText'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Success!</strong> {{ session()->get('notificationText') }}
                    </div>
                  @endif

                  @if(session()->has('errorNotificationText'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>Opps!</strong> {{ session()->get('errorNotificationText') }}
                    </div>
                  @endif
                </div>
            </div>

          <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
            @yield('content')
        </div>
      </main>

      @include("avored-framework::layouts.footer")
    </div>
  </div>

  <script src="{{ mix('vendor/avored-admin/js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>