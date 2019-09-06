@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.attribute.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.attribute.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <attribute-save base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="attributeForm"
                method="post"
                action="{{ route('admin.attribute.store') }}"                    
                @submit="handleSubmit"
            >
                @csrf
                <a-tabs tabbar-gutter="15" tab-position="left" default-active-key="catalog.attribute.info">
                @foreach ($tabs as $tab)
                    <a-tab-pane :force-render="true" tab="{{ $tab->label() }}" key="{{ $tab->key() }}">
                        @php
                            $path = $tab->view();
                        @endphp
                        @include($path)
                    </a-tab-pane>
                @endforeach
                </a-tabs>
                
                <a-form-item class="mt-1">
                    <a-button type="primary" html-type="submit">
                        {{ __('avored::system.btn.save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="cancelAttribute"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </attribute-save>
    </a-col>
</a-row>
@endsection
