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
        <password-reset-page inline-template>
            <div>
                <a-row type="flex" align="middle">
                    <a-col :span="12">
                        <a-row type="flex">
                        <a-col :span="20" :offset="2">
                        
                            <a-card title="{{ __('avored::system.forgot-password-title') }}">
                                <a-form
                                    :form="form"
                                    method="post"
                                    action="{{ route('admin.password.email') }}"
                                    @submit="handleSubmit"
                                >
                                    @csrf()
                                    <a-form-item
                                        @if ($errors->has('email'))
                                            validate-status="error"
                                            help="{{ $errors->first('email') }}"
                                        @endif
                                        label="{{ __('avored::system.email') }}">
                                    <a-input
                                        :auto-focus="true"
                                        name="email"
                                        v-decorator="[
                                        'email',
                                        {
                                            rules: [
                                                {   required: true, 
                                                    message: '{{ __('avored::validation.required', ['attribute' => 'email']) }}' 
                                                }
                                            ]
                                        }
                                        ]"
                                    />
                                    </a-form-item>

                                    <a-form-item>
                                        <a-button
                                            type="primary"
                                            :loading="loadingSubmitBtn"
                                            html-type="submit"
                                        >
                                            {{ __('avored::system.password-reset-btn') }}
                                        </a-button>

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
                                src="{{ asset('avored-admin/images/avored_admin_login.svg')}}" 
                                width="55%" alt="AvoRed Admin Login" />
                        </a-col>
                        </a-row>
                    </a-col>
                </a-row>
            </div>
         
        </password-reset-page>
    </div>
    @stack('scripts')
</body>
</html>
