@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::order.order.show.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::order.order.show.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">        
        <a-card title="{{ __('avored::order.order.show.info') }}">
            <p>{{ __('avored::order.order.show.id')}}: <b>{{ $order->id }}</b></p>
            <p>{{ __('avored::order.order.show.payment_option')}}: <b>{{ $order->payment_option }}</b></p>
            <p>{{ __('avored::order.order.show.shipping_option')}}: <b>{{ $order->shipping_option }}</b></p>
            <p>{{ __('avored::order.order.show.created_at')}}: <b>{{ $order->created_at->format('d-M-Y') }}</b></p>    
        </a-card>
        <a-card class="mt-1" title="{{ __('avored::order.order.show.product_info') }}">
            @php
                $total = 0;
            @endphp
            @foreach ($order->products as $product)
                <a-row :gutter="20">
                    <a-col :span="8">
                        {{ $product->product->name }}
                    </a-col>
                    <a-col :span="4">
                        {{ number_format($product->qty, 2) }}
                    </a-col>
                    <a-col :span="4">
                        {{ $order->currency->symbol }} {{ number_format($product->product->price, 2) }}
                    </a-col>
                    <a-col :span="4">
                        {{ $order->currency->symbol }} {{ number_format($product->tax_amount, 2) }}
                    </a-col>
                    <a-col :span="4">
                        <b>{{ $order->currency->symbol }} {{ number_format($product->price * $product->qty, 2) }}</b>
                    </a-col>
                </a-row>
                @php
                    $total += $product->price * $product->qty;
                @endphp
                <a-divider></a-divider>
                <a-row class="mt-1"  :gutter="20" align="end">
                    <a-col :offset="20" :span="4">
                        <b>{{ $order->currency->symbol }}{{ number_format($total, 2) }}</b>
                    </a-col>
                </a-row>
            @endforeach     
        </a-card>
    </a-col>
</a-row>
@endsection
