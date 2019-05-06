@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.category.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.category.edit.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <category-edit base-url="{{ asset(config('avored.admin_url')) }}" category="{{ $category }}" inline-template>
        <div>
            <h1>{{ __('avored::catalog.category.edit.title') }}</h1>
            <a-form 
                :form="categoryForm"
                method="post"
                action="{{ route('admin.category.update', $category->id) }}"                    
                @submit="handleSubmit"
            >
                    @csrf
                    @method('put')
               <a-form-item
                    @if ($errors->has('name'))
                        validate-status="error"
                        help="{{ $errors->first('name') }}"
                    @endif
                    label="{{ __('avored::catalog.category.name') }}"
                >
                    <a-input
                        :auto-focus="true"
                        name="name"
                        v-decorator="[
                        'name',
                        {initialValue: '{{ $category->name }}' },
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
                    @if ($errors->has('slug'))
                        validate-status="error"
                        help="{{ $errors->first('slug') }}"
                    @endif
                    label="{{ __('avored::catalog.category.slug') }}"
                >
                    <a-input
                        :auto-focus="true"
                        name="slug"
                        v-decorator="[
                        'slug',
                        {initialValue: '{{ $category->slug }}' },
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('avored::validation.required', ['attribute' => 'slug']) }}' 
                                }
                            ]
                        }
                        ]"
                    ></a-input>
                </a-form-item>
                <a-form-item
                    @if ($errors->has('meta_title'))
                        validate-status="error"
                        help="{{ $errors->first('meta_title') }}"
                    @endif
                    label="{{ __('avored::catalog.category.meta_title') }}"
                >
                    <a-input
                        :auto-focus="true"
                        name="meta_title"
                        v-decorator="[
                        'meta_title',
                        {initialValue: '{{ $category->meta_title }}' },
                        {rules: 
                            [
                                {   required: false, 
                                    message: '{{ __('avored::validation.required', ['attribute' => 'meta_title']) }}' 
                                }
                            ]
                        }
                        ]"
                    ></a-input>
                </a-form-item>
                <a-form-item
                    @if ($errors->has('meta_description'))
                        validate-status="error"
                        help="{{ $errors->first('meta_description') }}"
                    @endif
                    label="{{ __('avored::catalog.category.meta_description') }}"
                >
                    <a-input
                        :auto-focus="true"
                        name="meta_description"
                        v-decorator="[
                        'meta_description',
                        {initialValue: '{{ $category->meta_description }}' },
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('avored::validation.required', ['attribute' => 'meta_description']) }}' 
                                }
                            ]
                        }
                        ]"
                    ></a-input>
                </a-form-item>
                
                
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
