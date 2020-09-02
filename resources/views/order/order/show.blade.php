@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.show', ['attribute' => __('avored::system.terms.order')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl px-5 text-red-700 font-semibold">
            {{ __('avored::system.pages.title.show', ['attribute' => __('avored::system.terms.order')]) }}
        </div>
    </div>
@endsection
@section('content')
<div class="block">
    <div class="flex">
        <div class="w-1/2">
            <div class="border rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.order')]) }}
        </div>
        <div class="p-5">
            <p>{{ __('avored::system.fields.order_id')}}: <b>{{ $order->id }}</b></p>
            <p>{{ __('avored::system.fields.payment_option')}}: <b>{{ $order->payment_option }}</b></p>
            <p>{{ __('avored::system.fields.shipping_option')}}: <b>{{ $order->shipping_option }}</b></p>
            <p>{{ __('avored::system.fields.created_at')}}: <b>{{ $order->created_at->format('d-M-Y') }}</b></p>    
        </div>
    </div>

    <div class="border mt-5 rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.customer')]) }}
        </div>
        <div class="p-5">
            <p>{{ __('avored::system.fields.customer_name')}}: <b>{{ $order->customer->first_name }} {{ $order->customer->last_name }}</b></p>
            <p>{{ __('avored::system.fields.customer_email')}}: <b>{{ $order->customer->email }}</b></p> 
            <p>{{ __('avored::system.fields.customer_phone')}}: <b>{{ $order->customer->phone }}</b></p> 
        
        
        </div>
    </div>

    <div class="border mt-5 rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.address')]) }}
        </div>
        <div class="p-5 flex w-full">
            <div class="border rounded w-1/2">
                <div class="border-b font-semibold text-red-500 p-5 py-3">
                    {{ __('avored::system.terms.shipping_address') }}
                </div>
                <div class="p-5">
                    {{ $order->shippingAddress->first_name }} {{ $order->shippingAddress->last_name }} <br/>
                    {{ $order->shippingAddress->phone }} <br/>
                    {{ $order->shippingAddress->address1 }} {{ $order->shippingAddress->address2 }} <br/>
                    {{ $order->shippingAddress->city }} <br/>
                    {{ $order->shippingAddress->state }} <br/>
                    {{ $order->shippingAddress->country->name }} <br/>
                    {{ $order->shippingAddress->postcode }} <br/>
                </div>
            </div>

            <div class="border rounded w-1/2 ml-5">
                <div class="border-b font-semibold text-red-500 p-5 py-3">
                    {{ __('avored::system.terms.billing_address') }}
                </div>
                <div class="p-5">
                    {{ $order->billingAddress->first_name }} {{ $order->billingAddress->last_name }} <br/>
                    {{ $order->billingAddress->phone }} <br/>
                    {{ $order->billingAddress->address1 }} {{ $order->billingAddress->address2 }} <br/>
                    {{ $order->billingAddress->city }} <br/>
                    {{ $order->billingAddress->state }} <br/>
                    {{ $order->billingAddress->country->name }} <br/>
                    {{ $order->billingAddress->postcode }} <br/>
                </div>
            </div>  
        </div>
    </div>
        </div>
        
        <div class="w-1/2 ml-5">
               <div class="border rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::system.pages.title.info', ['attribute' => __('avored::system.terms.product')]) }}
        </div>
        <div class="p-5">
            @php
                $total = 0;
            @endphp
            @foreach ($order->products as $product)
                <div class="flex py-3 items-center">
                    <div class="w-3/6">
                        {{ $product->product->name }}
                    </div>
                    <div class="w-1/6">
                        {{ number_format($product->qty, 2) }}
                    </div>
                    <div class="w-1/6">
                        {{ $order->currency->symbol }} {{ number_format($product->product->price, 2) }}
                    </div>
                    <div class="w-1/6">
                        {{ $order->currency->symbol }} {{ number_format($product->tax_amount, 2) }}
                    </div>
                    <div class="w-1/6">
                        <div class="font-semibold">
                            {{ $order->currency->symbol }} {{ number_format($product->price * $product->qty, 2) }}
                        </div>
                    </div>
                </div>
                @php
                    $total += $product->price * $product->qty;
                @endphp
                
            @endforeach  
            <hr/>
            <div class="flex py-3 items-center">
                <div class="w-3/6"></div>
                <div class="w-1/6"></div>
                <div class="w-1/6"></div>
                <div class="w-1/6">
                    {{ __('avored::system.fields.total') }}
                </div>
                <div class="w-1/6">
                    <div class="font-semibold">
                        {{ $order->currency->symbol }} {{ number_format($total, 2) }}
                    </div>
                </div>
            </div>  
        </div>
    </div>
        </div>
    </div>
    


</div>
@endsection
