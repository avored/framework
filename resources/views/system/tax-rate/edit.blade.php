@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.tax-rate.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.tax-rate.edit.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <tax-rate-save
            base-url="{{ asset(config('avored.admin_url')) }}"
            :tax-rate="{{ $taxRate }}" inline-template>
        <div>
            <a-form 
                :form="taxRateForm"
                method="post"
                action="{{ route('admin.tax-rate.update', $taxRate->id) }}"                    
                @submit="handleSubmit"
            >
                @csrf
                @method('put')
                @include('avored::system.tax-rate._fields')
                
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
                        v-on:click.prevent="cancelTaxRate"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
            </a-form>
            </div>
        </tax-rate-save>
    </a-col>
</a-row>
@endsection
