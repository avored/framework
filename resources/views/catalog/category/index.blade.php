@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.category')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.category')]) }}
        </div>
        <div class="ml-auto">
            <a href="{{ route('admin.category.create') }}"
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
    <x-avored-table class="flex-col space-y-3">
        <x-slot name="head">
            <x-avored-table-header>{{ __('avored::system.id') }}</x-avored-table-header>
            <x-avored-table-header>{{ __('avored::system.name') }}</x-avored-table-header>
            <x-avored-table-header>{{ __('avored::system.slug') }}</x-avored-table-header>
            <x-avored-table-header>{{ __('avored::system.meta_title') }}</x-avored-table-header>
            <x-avored-table-header>{{ __('avored::system.meta_description') }}</x-avored-table-header>
            <x-avored-table-header>{{ __('avored::system.actions') }}</x-avored-table-header>
        </x-slot>
        <x-slot name="body">
            @foreach ($categories as $category)
                <x-avored-table-row class="{{ ($loop->index % 2 === 0) ? 'bg-white' : 'bg-gray-200'  }}">
                    <x-avored-table-cell>{{ $category->id }}</x-avored-table-cell>
                    <x-avored-table-cell>{{ $category->name }}</x-avored-table-cell>
                    <x-avored-table-cell>{{ $category->slug }}</x-avored-table-cell>
                    <x-avored-table-cell>{{ $category->meta_title }}</x-avored-table-cell>
                    <x-avored-table-cell>{{ $category->meta_description }}</x-avored-table-cell>
                    <x-avored-table-cell>
                        <div class="flex items-center">
                            <a href="{{ route('admin.category.edit', $category) }}">
                                <svg class="h-6 w-6" fill="currentColor">
                                    <path
                                        class="heroicon-ui"
                                        d="M6.3 12.3l10-10a1 1 0 011.4 0l4 4a1 1 0 010 1.4l-10 10a1 1 0 01-.7.3H7a1 1 0 01-1-1v-4a1 1 0 01.3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 012 0v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6c0-1.1.9-2 2-2h6a1 1 0 010 2H4v14h14v-6z"
                                    />
                                </svg>
                            </a>

                            <button type="button" class="text-red-700"
                                onclick="
                                    event.preventDefault();
                                    document.getElementById('category-destroy-form-{{ $category->id }}').submit()
                                ">
                                <form method="post" id="category-destroy-form-{{ $category->id }}" action="{{ route('admin.category.destroy', $category) }}" class="hidden">
                                    @csrf
                                    @method('delete')
                                </form>
                                <svg class="h-6 w-6" fill="currentColor">
                                    <path
                                        class="heroicon-ui"
                                        d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"
                                    />
                                </svg>
                            </button>
                        </div>
                    </x-avored-table-cell>
                </x-avored-table-row>
            @endforeach
        </x-slot>
    </x-avored-table>

    <div class="block mt-5">
        {{ $categories->render() }}
    </div>
@endsection
