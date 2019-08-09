@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::cms.menu.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::cms.menu.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <menu-save
            :prop-front-menus="{{ $frontMenus }}"
            :prop-categories="{{ $categories }}" 
            base-url="{{ asset(config('avored.admin_url')) }}" 
            inline-template>
        <div>
            <a-row :gutter="30" class="menu-save-page">
                <a-form 
                    :form="form" 
                    v-on:submit="handleSubmit"
                    method="post" 
                    action="{{ route('admin.menu-group.store') }}">
                
                @csrf
                @include('avored::cms.menu._fields')
                 <a-col class="mt-1" :span="24">
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
                        v-on:click.prevent="cancelMenu"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
                </a-col>
                </a-form>
            </a-row>
        </div>
        </menu-save>
    </a-col>
</a-row>
@endsection
