<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Reset Password: AvoRed Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/avored-admin/css/vue.css') }}" rel="stylesheet">

</head>
<body>
<div id="app" class="container-fluid">
<password-reset-page inline-template>
    <div class="row justify-content-center align-items-center" style="height: 100vh;" >
            <div class="col-6">
                <div class="offset-1 col-md-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">{{ __('avored-framework::user.auth.reset_password') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="col-12">

                            <form class="form-horizontal" method="POST" action="{{ route('admin.password.email.post') }}">
                                @csrf

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
                                
                                    <button 
                                        type="submit" 
                                        :disabled='isSubmitButtonDisbled'  
                                        class="btn btn-primary">
                                        {{ __('avored-framework::user.auth.reset_password_link') }}
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
</password-reset-page>
</div>
<script type="text/javascript" src="{{ asset('vendor/avored-admin/js/vue.js') }}"></script>


</body>
</html>
