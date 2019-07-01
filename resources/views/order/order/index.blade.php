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
                    <a-popconfirm
                        ok-text="ChangeStatus"
                        @confirm="onChangeStatus(record)">
                        <template slot="title">
                            {{ __('Please Select:') }}
                            <a-select :style="{width: '150px'}" @change="changeStatusDropdown">
                                @foreach ($orderStatuses as $orderStatus)                                
                                    <a-select-option value="{{ $orderStatus->id }}">{{ $orderStatus->name }}</a-select-option>
                                @endforeach
                            </a-select>
                            <input type="hidden" v-model="changeStatusId" />
                        </template>

                        <a href="javascript:;">
                            {{ __('Change Status') }}
                        </a>
                    </a-popconfirm>
                </span>
            </a-table>
        </order-table>
    </a-col>
</a-row>
@endsection
