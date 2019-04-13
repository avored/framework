<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AvoRed Admin Login</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/avored-admin/css/vue.css') }}" rel="stylesheet">
</head>
<body >
<div id="app">
    <login-page inline-template>
    <div class="row justify-content-center align-items-center" style="height: 100vh;" >
        <div class="col-6">
            <div class="offset-1 col-md-10">
            <div class="card">

                <div class="card-header bg-primary text-white">
                    {{ __('avored-framework::lang.user.login-card-title') }}
                </div>
                <div class="card-body" >

                    <form method="post" action="{{ route('admin.login') }}" >
                        @csrf

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="text"
                                name="email"
                                :autofocus="true"
                                v-model="email"
                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                id="email" />
                                @if ($errors->has('email'))
                                    <span class='invalid-feedback'>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password"
                                name="password"
                                v-model="password"
                                class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                id="password" />
                                @if ($errors->has('password'))
                                <span class='invalid-feedback'>
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">

                            <button
                                type="submit"
                                :disabled='isLoginDisbled'
                                class="btn btn-primary"
                            >
                                {{ __('avored-framework::lang.admin-login-button-title') }}
                            </button>

                            <a href="{{ route('admin.password.reset') }}">
                                {{ __('avored-framework::lang.admin-login-forget-password-link') }}
                            </a>
                        </div>

                    </form>
                </div>
                </div>
            </div>
        </div>
        <div class="col-6" style="border-left:1px solid;height:100vh;background-color:brown">
            
        </div>
    </div>
    </login-page>
</div>
<!-- Scripts -->
<script type="text/javascript" src="{{ asset('vendor/avored-admin/js/vue.js') }}"></script>
</body>
</html>
