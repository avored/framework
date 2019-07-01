@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::order.order.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::order.order.index.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">        
        <order-table inline-template base-url="{{ asset(config('avored.admin_url')) }}">
            <a-table :columns="columns" row-key="id" :data-source="{{ $orders }}">
                <span slot="action" slot-scope="text, record">
                    @todo
                    <!-- a :href="getShowUrl(record)">
                        <a-icon type="edit"></a-icon>
                    </!-- -->
                </span>
            </a-table>
        </order-table>
    </a-col>
</a-row>
@endsection
