<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AvoRed Admin Password Reset</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/avored-admin/css/vue.css') }}" rel="stylesheet">
</head>
<body >

<div id="app" class="container-fluid">
<set-new-password-page inline-template>
    <div class="row justify-content-center align-items-center" style="height: 100vh;" >
        <div class="col-6">
            <div class="offset-1 col-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        {{ __('avored-framework::user.auth.reset_password') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-md-12">
                            <form method="POST"
                                action="{{ route('admin.password.reset.post') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}" />

                                <div class="form-group">
                                    <label for="email">{{ __('avored-framework::user.auth.email') }}</label>
                                    <input type="text"
                                        name="email"
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
                                    <label for="password">{{ __('avored-framework::user.auth.password') }}</label>
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
                                    <label for="password_confirmation">
                                        {{ __('avored-framework::user.auth.password_confirm') }}
                                    </label>
                                    <input type="password"
                                        name="password_confirmation"
                                        v-model="confirm_password"
                                        class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                        id="password_confirmation" />
                                        @if ($errors->has('password_confirmation'))
                                        <span class='invalid-feedback'>
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <button :disabled='isSubmitDisbled' type="submit" class="btn btn-primary">
                                        {{ __('avored-framework::user.auth.reset_password') }}
                                    </button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6" style="border-left:1px solid;height:100vh;background-color:brown">
            
        </div>
    </div>
</set-new-password-page>
</div>
<script type="text/javascript" src="{{ asset('vendor/avored-admin/js/vue.js') }}"></script>

</body>
</html>
