@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::promotion.promotion-code.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::promotion.promotion-code.edit.title') }}
        </div>
        {{-- <div class="ml-auto">
            <a href="{{ route('admin.promotion-code.create') }}"
                class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
            >
                <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                </svg>
                {{ __('avored::system.btn.create') }}
            </a>
        </div> --}}
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
                <a-tabs tabbar-gutter="15" tab-position="left" default-active-key="promotion.promotion-code.info">
                @foreach ($tabs as $tab)
                    <a-tab-pane :force-render="true" tab="{{ $tab->label() }}" key="{{ $tab->key() }}">
                        @php
                            $path = $tab->view();
                        @endphp
                        @include($path)
                    </a-tab-pane>
                @endforeach
                </a-tabs>
                

                
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('avored::system.btn.save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="clickCancelButton"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </form>
        </div>
    </promotion-code-edit>
</div>
@endsection
