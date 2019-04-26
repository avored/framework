@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.language.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.language.edit.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <language-edit base-url="{{ asset(config('avored.admin_url')) }}" language="{{ $language }}" inline-template>
        <div>
            <h1>{{ __('avored::system.language.edit.title') }}</h1>
            <a-form 
                :form="languageForm"
                method="post"
                action="{{ route('admin.language.update', $language->id) }}"                    
                @submit="handleSubmit"
            >
                    @csrf
                    @method('put')
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
                        {initialValue: '{{ $language->name }}' },
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
                    @if ($errors->has('code'))
                        validate-status="error"
                        help="{{ $errors->first('code') }}"
                    @endif
                    label="{{ __('avored::system.language.code') }}"
                >
                    <a-input
                        :auto-focus="true"
                        name="code"
                        v-decorator="[
                        'code',
                        {initialValue: '{{ $language->code }}' },
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('avored::validation.required', ['attribute' => 'code']) }}' 
                                }
                            ]
                        }
                        ]"
                    ></a-input>
                </a-form-item>
                <a-form-item
                    @if ($errors->has('is_default'))
                        validate-status="error"
                        help="{{ $errors->first('is_default') }}"
                    @endif
                    label="{{ __('avored::system.language.is_default') }}"
                >
                    <a-switch
                        @if ($language->is_default == 1)
                            default-checked
                        @endif 
                        v-on:change="onChange">
                    </a-switch>
                </a-form-item>
                <input type="hidden" v-model="is_default" name="is_default"  />
            
                
                <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('avored::system.btn_save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="cancelLanguage"
                    >
                        {{ __('avored::system.btn_cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </role-edit>
    </a-col>
</a-row>
@endsection
