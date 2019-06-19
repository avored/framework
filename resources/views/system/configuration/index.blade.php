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
        <a-card :bordered="false" :bodyStyle="{ padding: '16px 0', height: '100%' }" :style="{ height: '100%' }">
            <configuration-save base-url="{{ asset(config('avored.admin_url')) }}"  inline-template> 
            <div class="account-settings-info-main" class="horizontal">
                <div class="account-settings-info-left">
                <a-menu
                    mode-data="device == 'mobile' ? 'horizontal' : 'inline'"
                    mode="vertical"
                    data-style="{ border: '0', width: device == 'mobile' ? '560px' : 'auto'}"
                    :style="{ border: '0', width: 'auto'}"
                    type="inner">
                    
                    <a-menu-item key="/account/settings/base">
                        <a  href="{{ route('admin.configuration.index') }}">
                            {{ __('avored::system.configuration.nav.basic_setting') }}
                        </a>
                    </a-menu-item>
                    
                </a-menu>
                </div>
                <div class="account-settings-info-right">
                    <div class="account-settings-info-title">
                        <span>{{ __('avored::system.configuration.nav.basic_setting') }}</span>
                    </div>

                <a-form 
                    :form="configurationForm"
                    method="post"
                    v-on:submit="handleSubmit"
                    action="{{ route('admin.configuration.store') }}">

                    @csrf
                    <a-form-item
                        @if ($errors->has('site_name'))
                            validate-status="error"
                            help="{{ $errors->first('site_name') }}"
                        @endif
                        label="{{ __('avored::system.configuration.basic.site_name') }}">
                        <a-input
                            :auto-focus="true"
                            name="site_name"
                            v-decorator="[
                            'site_name',
                            {initialValue: '{{ ($repository->getValueByCode('site_name')) ?? '' }}'},
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => __('avored::system.configuration.basic.site_name')]) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>

                    <a-form-item>
                        <a-button type="primary" html-type="submit">
                            {{ __('avored::system.btn.save') }}
                        </a-button>
                        
                        <a-button class="ml-1" type="default"v-on:click.prevent="cancelConfiguration">
                            {{ __('avored::system.btn.cancel') }}
                        </a-button>
                    </a-form-item>
                   
                   </a-form>
                </div>
            </div>
            </configuration-save>
        </a-card>
    </a-col>
</a-row>
@endsection
