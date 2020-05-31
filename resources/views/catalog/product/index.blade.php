@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.product.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.product.index.title') }}
@endsection

@section('content')
<div class="flex justify-end mt-3">
    <a 
        href="{{ route('admin.product.create') }}"
        class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700">
        <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
        </svg>
        {{ __('avored::system.btn.create') }}
    </a>
</div>

<product-table
        :init-products="{{ json_encode($products) }}"
        base-url="{{ asset(config('avored.admin_url')) }}"
></product-table>


{{-- <a-row type="flex" justify="center">
    <a-col :span="24">        
        <product-table inline-template base-url="{{ asset(config('avored.admin_url')) }}">
            <a-table :columns="columns" row-key="id" :data-source="{{ $products }}">
                <span slot="action" slot-scope="text, record">
                    
                    <a :href="getEditUrl(record)">
                        <a-icon type="edit"></a-icon>
                    </a>
                    <a :href="getDeleteUrl(record)" v-on:click.prevent="deleteProduct(record)">
                        <a-icon type="delete"></a-icon>
                    </a>
                </span>
            </a-table>
        </product-table>
    </a-col>
</a-row> --}}
@endsection
