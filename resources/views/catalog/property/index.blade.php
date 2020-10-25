@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.property')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.property')]) }}
        </div>
        <div class="ml-auto">
            <a href="{{ route('admin.property.create') }}"
                class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
            >
                <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                </svg>
                {{ __('avored::system.btn.create') }}
            </a>
        </div>
    </div>
@endsection

@section('content')
    <property-table
        :init-properties="{{ json_encode($properties) }}"
        filter-url="{{ route('admin.property.filter') }}"
        base-url="{{ asset(config('avored.admin_url')) }}"
    ></property-table>

@endsection
