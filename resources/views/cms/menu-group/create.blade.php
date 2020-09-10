@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.create', ['attribute' => __('avored::system.terms.menu')]) }}: AvoRed E commerce Admin Dashboard
@endsection


@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.create', ['attribute' => __('avored::system.terms.menu')]) }}
        </div>
    </div>
@endsection

@section('content')
<div class="block">
    
        <div class="w-full">
            <div class="menu-save-page">
                <form 
                    method="post" 
                    action="{{ route('admin.menu-group.store') }}">
                
                    @csrf
                       
                    <div class="mt-3 flex w-full">
                        <avored-input
                            label-text="{{ __('avored::system.fields.name') }}"
                            field-name="name"
                            init-value="{{ $menuGroup->name ?? '' }}" 
                            error-text="{{ $errors->first('name') }}"
                        >
                        </avored-input>
                    </div>

                    <div class="mt-3 flex w-full">
                        <avored-input
                            label-text="{{ __('avored::system.fields.identifier') }}"
                            field-name="identifier"
                            init-value="{{ $menuGroup->identifier ?? '' }}" 
                            error-text="{{ $errors->first('identifier') }}"
                        >
                        </avored-input>
                    </div>
                    
                    <div class="mt-3 py-3">
                        <button type="submit"
                            class="px-6 py-3 font-semibold leading-7  text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                        >   
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 inline-flex w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                            </svg>
                            <span class="ml-3">{{ __('avored::system.btn.save') }}</span>
                        </button>
                        
                        <a href="{{ route('admin.menu-group.index') }}"
                            class="px-6 py-3 font-semibold inline-block text-white leading-7 hover:text-white bg-gray-500 rounded hover:bg-gray-600">
                            <span class="leading-7">
                                {{ __('avored::system.btn.cancel') }}
                            </span>
                        </a>
                    </div>
              </form>
            </div>
        </div>
   
</div>
@endsection
