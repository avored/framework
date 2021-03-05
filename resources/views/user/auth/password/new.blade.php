<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title', 'AvoRed E commerce')</title>

    {!! Asset::renderCSS() !!}
    @push('styles')

</head>
<body>
    <div id="app">
        <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full bg-white rounded-md shadow-md p-6">
                <div>
                    <a href="https://avored.com" target="_blank">
                        <img class="mx-auto h-12 w-auto" 
                            src="{{ asset('/vendor/avored/images/logo_only.svg') }}" 
                            alt="AvoRed Ecommerce" />
                    </a>
                    <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                        {{ __('avored::system.set-new-password') }}
                    </h2>
                    <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                    </p>
                </div>
                
                <form class="mt-8" action="{{ route('admin.password.update') }}" method="POST">
                    @csrf()
                    <input type="hidden" name="remember" value="true" />
                    <div class="rounded-md shadow-sm">
                        <div class="mt-3">
                            @include('avored::system.form.input', [
                                'name' => 'email',
                                'label' => __('avored::system.email'),
                                'value' => ''
                            ])
                        </div>
                        
                    </div>

                    <div class="rounded-md shadow-sm">
                        <div class="mt-3">
                            @include('avored::system.form.input', [
                                'name' => 'password',
                                'type' => 'password',
                                'label' => __('avored::system.password'),
                                'value' => ''
                            ])
                            
                        </div>
                        
                    </div>

                    <div class="rounded-md shadow-sm">
                        <div class="mt-3">
                            @include('avored::system.form.input', [
                                'name' => 'password_confirmation',
                                'type' => 'password',
                                'label' => __('avored::system.confirm-password'),
                                'value' => ''
                            ])
                            
                        </div>
                        
                    </div>
                    <input type="hidden" name="token" value="{{ $token }}" />

                    
                    <div class="mt-6 relative">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-red-500 text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700"
                        >
                        <span class="absolute left-0 inset-y pl-3">
                            <svg 
                                class="h-5 w-5 text-red-500 hover:text-red-400" 
                                fill="currentColor" 
                                viewBox="0 0 20 20"
                            >
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" 
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </span>
                            {{ __('avored::system.change-password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {!! Asset::renderJS() !!}
    @push('scripts')
</body>
</html>
