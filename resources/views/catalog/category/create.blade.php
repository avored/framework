@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.category.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.category.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <category-create base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="categoryForm"
                method="post"
                action="{{ route('admin.category.store') }}"                    
                @submit="handleSubmit"
            >
                    @csrf
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
                        'code',
                        {rules: 
                            [
                                {   required: true, 
                                    message: '{{ __('avored::validation.required', ['attribute' => 'Slug']) }}' 
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
                        {rules: 
                            [
                                {   required: false, 
                                    message: '{{ __('avored::validation.required', ['attribute' => 'Meta Title']) }}' 
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
                        {rules: 
                            [
                                {   required: false, 
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
                        v-on:click.prevent="cancelCategory"
                    >
                        {{ __('avored::system.btn_cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </category-create>
    </a-col>
</a-row>
@endsection
