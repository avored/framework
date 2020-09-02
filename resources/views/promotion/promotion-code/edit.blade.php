@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.common.edit') . ' ' . __('avored::system.terms.promotion_code') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.common.edit') . ' ' . __('avored::system.terms.promotion_code') }}
        </div>
    </div>
@endsection


@section('content')
<div class="flex items-center">
        <promotion-code-save base-url="{{ asset(config('avored.admin_url')) }}" :promotion-code="{{ $promotionCode }}" inline-template>
        <div class="block w-full">
            <form 
                method="post"
                action="{{ route('admin.promotion-code.update', $promotionCode->id ?? null) }}"                    
                @submit="handleSubmit"
            >
                @csrf
                <avored-tabs>
                    @foreach ($tabs as $tab)
                        <avored-tab identifier="{{ $tab->key() }}" name="{{ $tab->label() }}">
                            @php
                                $path = $tab->view();
                            @endphp
                            @include($path)
                        </avored-tab>
                    @endforeach
                </avored-tabs>
                
                <div class="flex mt-5">
                    <button type="submit"
                        class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700">
                        <svg class="h-4 w-4 inline-block" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 01-2 2H2a2 2 0 01-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                        </svg>
                        <span class="inline-block">
                            {{ __('avored::system.btn.save') }}
                        </span>
                    </button>

                    <a 
                        class="px-4 py-2 ml-3 rounded leading-7 border border-gray-400"
                        href="{{ route('admin.promotion-code.index') }}">
                        {{ __('avored::system.btn.cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </promotion-code-edit>
</div>
@endsection
