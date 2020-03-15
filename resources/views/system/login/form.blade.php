<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    <script defer src="{{ asset('avored-admin/js/app.js') }}"></script>
    
    <!-- Styles -->
    <link href="{{ asset('avored-admin/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <login-fields inline-template>
              <div>
                <a-row type="flex" align="middle">
                    <a-col :span="12">
                        <a-row type="flex">
                        <a-col :span="20" :offset="2">
                            <a-card title="Card title">
                                <a-form
                                    :form="loginForm"
                                    method="post"
                                    action=""
                                    @submit="handleSubmit"
                                >
                                    @csrf
                                    <a-form-item label="Email Address">
                                    <a-input
                                        :auto-focus="true"
                                        name="email"
                                        v-decorator="[
                                        'email',
                                        {
                                            rules: [
                                                {   required: true, 
                                                    message: 'Email Address is required' 
                                                }
                                            ]
                                        }
                                        ]"
                                    />
                                    </a-form-item>
                                    
                                    <a-form-item 
                                    
                                        label="Password Label">
                                        <a-input
                                            name="password"
                                            type="password"
                                            v-decorator="[
                                            'password',
                                            {rules: [{ required: true, message: 'Password is required' }]}
                                            ]"
                                        />
                                    </a-form-item>
                                    
                                    <a-form-item>
                                        <a-button
                                            type="primary"
                                            :loading="loadingSubmitBtn"
                                            html-type="submit"
                                        >
                                            Login Button
                                        </a-button>

                                        <a class="ml-1" href="#forgot-password-url">Forgot password?</a>
                                    </a-form-item>
                                </a-form>
                            </a-card>
                        </a-col>
                        </a-row>
                    </a-col>
                
                    <a-col :span="12">
                    <a-row type="flex" align="middle" class="h-100 text-center">
                    <a-col :span="24">
                            <img 
                                class="height-100"
                                src="/avored-admin/images/avored_admin_login.svg" 
                                width="55%" alt="AvoRed Admin Login" />
                        </a-col>
                        </a-row>
                    </a-col>
                </a-row>
            </div>
        </login-fields>
    </div>
    @stack('scripts')
</body>
</html>
