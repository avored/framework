@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.product.edit.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.product.edit.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <product-save
            base-url="{{ asset(config('avored.admin_url')) }}"
            :product="{{ $product }}"
            :product-properties="{{ $product->properties }}"
            inline-template>
        <div>
            <a-form 
                :form="productForm"
                method="post"
                action="{{ route('admin.product.update', $product->id) }}"                    
                @submit="handleSubmit"
            >
                @csrf
                @method('put')

                <a-tabs tabbar-gutter="15" tab-position="left" default-active-key="basic">
                    <a-tab-pane tab="{{ __('Basic Info') }}" key="basic">
                        @include('avored::catalog.product._fields')
                    </a-tab-pane>
                    <a-tab-pane tab="{{ __('Product Images') }}" key="images" force-render>
                        @include('avored::catalog.product.cards.images')
                    </a-tab-pane>
                </a-tabs>
                
                
                <a-form-item class="mt-1">
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
