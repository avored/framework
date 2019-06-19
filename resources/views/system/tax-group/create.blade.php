@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.tax-group.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.tax-group.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <tax-group-save base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-form 
                :form="taxGroupForm"
                method="post"
                action="{{ route('admin.tax-group.store') }}"                    
                @submit="handleSubmit"
            >
                @csrf
                @include('avored::system.tax-group._fields') 
                
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
                        v-on:click.prevent="cancelTaxGroup"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </tax-group-save>
    </a-col>
</a-row>
@endsection
