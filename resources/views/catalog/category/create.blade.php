@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.common.create') . ' ' . __('avored::system.terms.category') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.common.create') . ' ' . __('avored::system.terms.category') }}
@endsection

@section('content')
<div class="mt-3">
        <category-save base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <form action="{{ route('admin.category.store') }}" @submit="handleSubmit" method="post">
                @csrf
                <a-tabs tabbar-gutter="15" tab-position="left" default-active-key="catalog.category.basic">
                    @foreach ($tabs as $tab)
                        <a-tab-pane :force-render="true"  tab="{{ $tab->label() }}" key="{{ $tab->key() }}">
                            @php
                                $path = $tab->view();
                            @endphp
                            @include($path)
                        </a-tab-pane>
                    @endforeach
                </a-tabs>
                
                <div class="flex mt-3">
                    <button type="submit"
                        class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700">
                        <svg class="h-4 w-4 inline-block" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 01-2 2H2a2 2 0 01-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                        </svg>
                        <span class="inline-block">{{ __('avored::system.btn.save') }}</span>
                    </button>

                    <a 
                        class="px-4 py-2 ml-3 rounded leading-7 border border-gray-400"
                        href="{{ route('admin.category.index') }}">
                        {{ __('avored::system.btn.cancel') }}
                    </a>
                </div>
            </form>
        </div>
        </category-save>
</div>
@endsection
