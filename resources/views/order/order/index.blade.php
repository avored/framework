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
        <order-table inline-template :order-status="{{ $orderStatuses }}" base-url="{{ asset(config('avored.admin_url')) }}">
            <div>
            <a-table :columns="columns" row-key="id" :data-source="{{ $orders }}">
                <span slot="order_status" slot-scope="text, record">
                    @{{ getOrderStatus(text) }}
                </span>
                <span slot="action" slot-scope="text, record">
                    
                    <a-dropdown>
                        <a class="ant-dropdown-link" href="#">
                        {{ __('avored::order.order.index.action') }} <a-icon type="down"></a-icon>
                        </a>
                        <a-menu slot="overlay">
                            <a-menu-item>
                                <a :href="orderShowAction(record)">
                                {{ __('avored::order.order.index.show') }}
                                </a>
                            </a-menu-item>
                            
                            
                            <a-menu-item>
                                <a @click.prevent="changeStatusMenuClick(record, $event)">
                                {{ __('avored::order.order.index.change_status') }}
                                </a>
                            </a-menu-item>
                            <a-menu-item>
                                <a @click.prevent="addTrackingCodeMenuClick(record, $event)">
                                {{ __('avored::order.order.index.add_tracking') }}
                                </a>
                            </a-menu-item>
                            <a-menu-item>
                                <a :href="downloadOrderAction(record)">
                                {{ __('avored::order.order.index.download_invoice') }}
                                </a>
                            </a-menu-item>
                            <a-menu-item>
                                <a :href="emailInvoiceOrderAction(record)">
                                {{ __('avored::order.order.index.email_invoice') }}
                                </a>
                            </a-menu-item>
                            <a-menu-item>
                                <a :href="shippingLabelOrderAction(record)">
                                {{ __('avored::order.order.index.download_shipping_label') }}
                                </a>
                            </a-menu-item>
                        </a-menu>
                    </a-dropdown>

                </span>
            </a-table>
            @include('avored::order.order.modal.track-code')
            @include('avored::order.order.modal.change-status')
            </div>
        </order-table>
    </a-col>
</a-row>


@endsection
