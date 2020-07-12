@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::cms.menu.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::cms.menu.edit.title') }}
        </div>
        {{-- <div class="ml-auto">
            <a href="{{ route('admin.page.create') }}"
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
        <menu-save 
            :prop-categories="{{ $categories }}"
            :prop-front-menus="{{ $frontMenus }}"
            :menu-group="{{ $menuGroup }}"
            :prop-menus="{{ $menus }}"
            base-url="{{ asset(config('avored.admin_url')) }}" 
            inline-template>
        <div class="w-full block">
            <a-row :gutter="30" class="menu-save-page">
                <form 
                    v-on:submit="handleSubmit"
                    method="post" 
                    action="{{ route('admin.menu-group.update', $menuGroup->id) }}">
                
                    @csrf
                    @method('put')
                    @include('avored::cms.menu._fields')
                    <a-col class="mt-1" :span="24">
                        <a-form-item>
                            <a-button type="primary" html-type="submit">
                                {{ __('avored::system.btn.save') }}
                            </a-button>
                            
                            <a-button class="ml-1" type="default" v-on:click.prevent="cancelMenu">
                                {{ __('avored::system.btn.cancel') }}
                            </a-button>
                        </a-form-item>
                    </a-col>
                </form>
            </a-row>
        </div>
    </menu-save>
</div>
@endsection
