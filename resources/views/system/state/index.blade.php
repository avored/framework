@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.state.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::system.state.index.title') }}
@endsection

@section('content')
<a-row type="flex" class="mb-1" justify="end">
    <a-col>
        <a 
            href="{{ route('admin.state.create') }}"
            class="ant-btn ant-btn-primary">
            <a-icon type="plus"></a-icon>
            {{ __('avored::system.btn.create') }}
        </a>
    </a-col>
</a-row>
<a-row type="flex" justify="center">
    <a-col :span="24">        
        <state-table inline-template base-url="{{ asset(config('avored.admin_url')) }}" :states="{{ $states }}">
            <a-table @change="handleTableChange" :columns="columns" row-key="id" :data-source="states">
                <span slot="action" slot-scope="text, record">
                    
                    <a :href="getEditUrl(record)">
                        <a-icon type="edit"></a-icon>
                    </a>
                    <a :href="getDeleteUrl(record)" v-on:click.prevent="deleteState(record)">
                        <a-icon type="delete"></a-icon>
                    </a>
                </span>
            </a-table>
        </state-table>
    </a-col>
</a-row>
@endsection
