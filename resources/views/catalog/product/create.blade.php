@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.product.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.product.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <product-save base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="productForm"
                method="post"
                action="{{ route('admin.product.store') }}"                    
                @submit="handleSubmit"
            >
                @csrf

                <a-row :gutter="15" type="flex">
                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('name'))
                                validate-status="error"
                                help="{{ $errors->first('name') }}"
                            @endif
                            label="{{ __('avored::catalog.product.name') }}">
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
                    </a-col>


                    <a-col :span="12">
                        <a-form-item
                            @if ($errors->has('slug'))
                                validate-status="error"
                                help="{{ $errors->first('slug') }}"
                            @endif
                            label="{{ __('avored::catalog.product.slug') }}">
                            <a-input
                                :auto-focus="true"
                                name="slug"
                                v-decorator="[
                                'slug',
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
                    </a-col>

                </a-row>

                <a-row>
                    <a-col :span="24">
                        <a-form-item
                            @if ($errors->has('type'))
                                validate-status="error"
                                help="{{ $errors->first('type') }}"
                            @endif
                            label="{{ __('avored::catalog.product.type') }}">

                            <a-select
                                @change="handleTypeChange"
                                v-decorator="[
                                'type',
                                {rules: 
                                    [
                                        {   required: true, 
                                            message: '{{ __('avored::validation.required', ['attribute' => 'Type']) }}' 
                                        }
                                    ]
                                }
                                ]">
                                @foreach ($typeOptions as $typeVal => $typeLabel)
                                    <a-select-option value="{{ $typeVal }}">{{ $typeLabel }}</a-select-option>
                                @endforeach
                            </a-select>
                        </a-form-item>
                        <input name="type" v-model="type" type="hidden" />
                    
                    </a-col>
                </a-row>





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
                        v-on:click.prevent="cancelProduct"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </product-save>
    </a-col>
</a-row>
@endsection
