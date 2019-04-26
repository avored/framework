@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.language.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.language.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <language-create base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="languageForm"
                method="post"
                action="{{ route('admin.language.store') }}"                    
                @submit="handleSubmit"
            >
                    @csrf
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
                    <a-switch v-on:change="onChange"></a-switch>
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
                        v-on:click.prevent="cancelRole"
                    >
                        {{ __('avored::system.btn_cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </role-create>
    </a-col>
</a-row>
@endsection
