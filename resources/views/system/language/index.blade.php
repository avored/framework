@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.language.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.language.index.title') }}
@endsection

@section('content')
<a-row type="flex" class="mb-1" justify="end">
    <a-col>
        <a 
            href="{{ route('admin.language.create') }}"
            class="ant-btn ant-btn-primary">
            <a-icon type="plus"></a-icon>
            {{ __('avored::system.btn.create') }}
        </a>
    </a-col>
</a-row>
<a-row type="flex" justify="center">
    <a-col :span="24">        
        <language-table
            :languages="{{ $languages }}"
            inline-template
            base-url="{{ asset(config('avored.admin_url')) }}">

            <a-table :columns="columns" row-key="id" @change="handleTableChange" :data-source="languages">
                <span slot="action" slot-scope="text, record">
                    
                    <a :href="getEditUrl(record)">
                        <a-icon type="edit"></a-icon>
                    </a>
                    <a :href="getDeleteUrl(record)" v-on:click.prevent="deleteLanguage(record)">
                        <a-icon type="delete"></a-icon>
                    </a>
                </span>
            </a-table>
        </language-table>
    </a-col>
</a-row>
@endsection
