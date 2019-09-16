@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::promotion.promotion-code.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::promotion.promotion-code.index.title') }}
@endsection

@section('content')
<a-row type="flex" class="mb-1" justify="end">
    <a-col>
        <a 
            href="{{ route('admin.promotion.code.edit') }}"
            class="ant-btn ant-btn-primary">
            <a-icon type="plus"></a-icon>
            {{ __('avored::system.btn.create') }}
        </a>
    </a-col>
</a-row>
<a-row type="flex" justify="center">
    <a-col :span="24">        
        <promotion-code-table inline-template base-url="{{ asset(config('avored.admin_url')) }}" :promotion-codes="{{ $promotionCodes }}">
            <a-table :columns="columns" row-key="id" @change="handleTableChange" :data-source="promotionCodes">
                <span slot="action" slot-scope="text, record">
                    
                    <a :href="getEditUrl(record)">
                        <a-icon type="edit"></a-icon>
                    </a>
                    <a :href="getDeleteUrl(record)" v-on:click.prevent="clickOnDeleteIcon(record)">
                        <a-icon type="delete"></a-icon>
                    </a>
                </span>
            </a-table>
        </promotion-code-table>
    </a-col>
</a-row>
@endsection
