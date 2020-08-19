@extends('avored::layouts.app')

@section('meta_title')
    AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.terms.dashboard') }}
        </div>
    </div>
@endsection

@section('content')
<div class="md:flex sm:block justify-around mb-5">
    {{ $orderWidget->render() }}
    {{ $customerWidget->render() }}
    {{ $revenueWidget->render() }}
</div>

<div class="flex mt-5 justify-around my-5">
    <div class="bg-white border border-gray-400 w-full rounded">
        <div class="font-semibold text-md p-4 border-b">
            Admin Dashboard
        </div>
        <div class="p-4">
            <p>We will really appriciate if you give us any feedback about the project.
            It helps us to developed more better.</p>
            <p>You can help us in my ways like helping in our 
                <a href="https://github.com/avored/documentation" title="AvoRed Documantation Repository">
                    docs
                </a>, 
                <a href="https://github.com/avored/framework" title="AvoRed Framework Repository">
                    framework
                </a>, or create an
                <a href="https://github.com/avored/laravel-ecommerce/issues" title="Avored laravel repository">
                    issue
                </a>.
            </p>
            
        </div>
    </div>
</div>

@endsection
