@extends('avored-framework::layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="main-title-wrap">
            <div class='h2'>
                {{  __('avored-framework::orders.order-details') }} (#{{ $order->id }}) 

                @if($order->orderStatus->name === "Delivered")
                <small><span class="badge badge-success">{{ $order->orderStatus->name }}</span></small>
                @else
                <small><span class="badge badge-info">{{ $order->orderStatus->name }}</span></small>
                @endif

                <div class="float-right">
                    <button type="button" data-toggle="modal" data-target="#changeModal" class="btn btn-dark">{{  __('avored-framework::orders.change-status') }}</button>
                    <button type="button" 
                            data-toggle="modal" 
                            data-target="#add-track-code-model" 
                            class="btn btn-dark">
                        {{  __('avored-framework::orders.add-track-code') }}
                        </button>

                    <a href="{{ route('admin.order.send-email-invoice', $order->id) }}" class="btn btn-dark">{{  __('avored-framework::orders.send-invoice') }}</a>

                </div>
            </div>
            
           

            <div class="clearfix"></div>
                <div class="mt-3 card">
                    <div class="card-header text-white bg-secondary"><span class="fa fa-user"></span> {{  __('avored-framework::orders.customer-data') }}</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{  __('avored-framework::orders.shipping-address') }}</h4>

                                <p>
                                    {{ $order->shipping_address->first_name }} {{ $order->shipping_address->last_name }}
                                    <br/>
                                    {{ $order->shipping_address->address1 }}<br/>
                                    {{ $order->shipping_address->address2 }}<br/>
                                    {{ $order->shipping_address->area }}<br/>
                                    {{ $order->shipping_address->city }}<br/>
                                    {{ $order->shipping_address->state }} {{ $order->shipping_address->country->name }}
                                    <br/>
                                    {{ $order->shipping_address->phone }}<br/>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h4>{{  __('avored-framework::orders.billing-address') }}</h4>

                                <p>
                                    {{ $order->billing_address->first_name }} {{ $order->shipping_address->last_name }}
                                    <br/>
                                    {{ $order->billing_address->address1 }}<br/>
                                    {{ $order->billing_address->address2 }}<br/>
                                    {{ $order->billing_address->area }}<br/>
                                    {{ $order->billing_address->city }}<br/>
                                    {{ $order->billing_address->state }} {{ $order->shipping_address->country->name }}
                                    <br/>
                                    {{ $order->billing_address->phone }}<br/>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $product)
                                <tr>
                                    <td>
                                        {{ $product->name }}

                                        @if($product->type == "VARIATION")
                                            @foreach($order->orderProductVariation as $orderProductVariation)
                                                <p>
                                                    {{ $orderProductVariation->attribute->name }}
                                                    :
                                                    {{   $orderProductVariation->attributeDropdownOption->display_text }}
                                                </p>

                                            @endforeach
                                        @endif

                                    </td>
                                    <td> {{ $product->getRelationValue('pivot')->qty }} </td>
                                    <td> {{ $product->getRelationValue('pivot')->price }} </td>
                                    <td> {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header text-white bg-secondary">{{  __('avored-framework::orders.other-data') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Shipping Option</th>
                                <td><span class="badge badge-info"> {{ $order->shipping_option }} </span></td>
                            </tr>
                            <tr>
                                <th>Payment Option</th>
                                <td>{{ $order->payment_option }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-3 card">
                    <div class="card-header text-white bg-secondary"><span class="fa fa-history"></span> {{  __('avored-framework::orders.history') }}</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">{{  __('avored-framework::orders.history-action') }}</th>
                                    <th scope="col">{{  __('avored-framework::orders.history-updated-at') }}</th>
                                </tr>
                            </thead>
                            @foreach($order->history as $orderHistory)
                                <tbody>
                                    <tr>
                                        <td>This Order status has changed to {{ $orderHistory->orderStatus->name }}</td>
                                        <td>{{ $orderHistory->updated_at }}</td>
                                    </tr>
                                </tbody>                            
                                @endforeach
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    @include('avored-framework::order.models.add-track-code')
    @include('avored-framework::order.models.change-status')
@endsection

