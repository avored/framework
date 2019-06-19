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
                @include('avored::catalog.attribute._fields') 
                
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
