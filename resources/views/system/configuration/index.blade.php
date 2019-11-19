@extends('avored::layouts.app')

@section('meta_title')
    AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    Configuration
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <a-card :bordered="false" :style="{ padding: '16px 0', height: '100%' }" :style="{ height: '100%' }">
            <configuration-save base-url="{{ asset(config('avored.admin_url')) }}"  inline-template>
            <a-form
                    :form="configurationForm"
                    method="post"
                    v-on:submit="handleSubmit"
                    action="{{ route('admin.configuration.store') }}">

                    @csrf
                  
                    <a-tabs
                        default-active-key="system.configuration.basic"
                        tab-position="left">
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
                        <a-button type="primary" html-type="submit">
                            {{ __('avored::system.btn.save') }}
                        </a-button>
                        
                        <a-button class="ml-1" type="default"v-on:click.prevent="cancelConfiguration">
                            {{ __('avored::system.btn.cancel') }}
                        </a-button>
                    </a-form-item>
                        
            </a-form>
            </configuration-save>
        </a-card>
    </a-col>
</a-row>
@endsection
