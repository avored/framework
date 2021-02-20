@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.category') }} {{ __('avored::system.list') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.category') }} {{ __('avored::system.list') }}
        </div>
        <div class="ml-auto">
            <a href="{{ route('admin.category.create') }}"
                class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
            >
                <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                </svg>
                {{ __('avored::system.create') }}
            </a>
        </div>
    </div>
@endsection

@section('content')


<div class="shadow w-full rounded">
    <table class="min-w-full">
        <thead class="bg-gray-700 text-white">
        <tr>
            <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                {{ __('avored::system.id') }}
            </th>
            <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                {{ __('avored::system.parent_id') }}
            </th>
            <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                {{ __('avored::system.name') }}
            </th>
            <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                {{ __('avored::system.slug') }}
            </th>
            <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                {{ __('avored::system.meta_title') }}
            </th>
            <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                {{ __('avored::system.meta_description') }}
            </th>
            <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                {{ __('avored::system.actions') }}
            </th>
            
        </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($categories as $category)
                <tr>
                    <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                        {{ $category->id }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                        {{ $category->parent->name ?? '' }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                        <a href="{{ route('admin.category.edit', $category) }}"
                            class="text-primary">
                            {{ $category->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                        {{ $category->slug }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                        {{ $category->meta_title }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                        {{ $category->meta_description }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                        <a href="{{ route('admin.category.edit', $category) }}"
                            class="text-primary">
                            {{ __('avored::system.edit') }}
                        </a>
                        <span class="mx-2">|</span>
                        <a href="{{ route('admin.category.destroy', $category) }}"
                            class="text-primary"
                            onclick="event.preventDefault();
                                document.getElementById('admin-category-{{ $category->id }}-delete').submit();">
                            {{ __('avored::system.delete') }}
                        </a>
                        <form id="admin-category-{{ $category->id }}-delete" 
                            action="{{ route('admin.category.destroy', $category) }}" 
                            method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
