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
            <div class="account-settings-info-main" class="horizontal">
                <div class="account-settings-info-left">
                <a-menu
                    mode-data="device == 'mobile' ? 'horizontal' : 'inline'"
                    mode="vertical"
                    data-style="{ border: '0', width: device == 'mobile' ? '560px' : 'auto'}"
                    :style="{ border: '0', width: 'auto'}"
                    type="inner"
                    
                >
                    <a-menu-item key="/account/settings/base">
                    <a  href="{ name: 'BaseSettings' }">
                        BaseSettings
                    </a >
                    </a-menu-item>
                    <a-menu-item key="/account/settings/security">
                    <a  href="{ name: 'SecuritySettings' }">
                        SecuritySettings
                    </a >
                    </a-menu-item>
                    <a-menu-item key="/account/settings/custom">
                    <a  href="{ name: 'CustomSettings' }">
                       CustomSettings
                    </a >
                    </a-menu-item>
                    <a-menu-item key="/account/settings/binding">
                    <a  href="{ name: 'BindingSettings' }">
                        Binding
                    </a >
                    </a-menu-item>
                    <a-menu-item key="/account/settings/notification">
                    <a  href="{ name: 'NotificationSettings' }">
                        User Notification
                    </a >
                    </a-menu-item>
                </a-menu>
                </div>
                <div class="account-settings-info-right">
                    <div class="account-settings-info-title">
                        <span>Basic Settings</span>
                    </div>

                    <a-form-item
                        @if ($errors->has('name'))
                            validate-status="error"
                            help="{{ $errors->first('name') }}"
                        @endif
                        label="{{ __('avored::system.language.name') }}"
                    >
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
                            {initialValue: '{{ ($language->name) ?? '' }}' },
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                    <a-form-item
                        @if ($errors->has('name'))
                            validate-status="error"
                            help="{{ $errors->first('name') }}"
                        @endif
                        label="{{ __('avored::system.language.name') }}"
                    >
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
                            {initialValue: '{{ ($language->name) ?? '' }}' },
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                    <a-form-item
                        @if ($errors->has('name'))
                            validate-status="error"
                            help="{{ $errors->first('name') }}"
                        @endif
                        label="{{ __('avored::system.language.name') }}"
                    >
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
                            {initialValue: '{{ ($language->name) ?? '' }}' },
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                    <a-form-item
                        @if ($errors->has('name'))
                            validate-status="error"
                            help="{{ $errors->first('name') }}"
                        @endif
                        label="{{ __('avored::system.language.name') }}"
                    >
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
                            {initialValue: '{{ ($language->name) ?? '' }}' },
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                    <a-form-item
                        @if ($errors->has('name'))
                            validate-status="error"
                            help="{{ $errors->first('name') }}"
                        @endif
                        label="{{ __('avored::system.language.name') }}"
                    >
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
                            {initialValue: '{{ ($language->name) ?? '' }}' },
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                    <a-form-item
                        @if ($errors->has('name'))
                            validate-status="error"
                            help="{{ $errors->first('name') }}"
                        @endif
                        label="{{ __('avored::system.language.name') }}"
                    >
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
                            {initialValue: '{{ ($language->name) ?? '' }}' },
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </div>
            </div>
        </a-card>
    </a-col>
</a-row>
@endsection
