@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::order.order.show.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::order.order.show.title') }}
        </div>
        {{-- <div class="ml-auto">
            <a href="{{ route('admin.order-status.create') }}"
                class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
            >
                <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                </svg>
                {{ __('avored::system.btn.create') }}
            </a>
        </div> --}}
    </div>
@endsection
@section('content')
<div class="block">
    <div class="border rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::order.order.show.info') }}
        </div>
        <div class="p-5">
            <p>{{ __('avored::order.order.show.id')}}: <b>{{ $order->id }}</b></p>
            <p>{{ __('avored::order.order.show.payment_option')}}: <b>{{ $order->payment_option }}</b></p>
            <p>{{ __('avored::order.order.show.shipping_option')}}: <b>{{ $order->shipping_option }}</b></p>
            <p>{{ __('avored::order.order.show.created_at')}}: <b>{{ $order->created_at->format('d-M-Y') }}</b></p>    
        </div>
    </div>


   <div class="border mt-5 rounded">
        <div class="border-b font-semibold text-red-500 p-5 py-3">
            {{ __('avored::order.order.show.product_info') }}
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
            <hr/>
            <div class="flex py-3 items-center">
                <div class="w-3/6">
                    
                </div>
                <div class="w-1/6">
                    
                </div>
                <div class="w-1/6">
                    
                </div>
                <div class="w-1/6">
                    Total
                </div>
                <div class="w-1/6">
                    <div class="font-semibold">
                        {{ $order->currency->symbol }} {{ number_format($total, 2) }}
                    </div>
                </div>
            </div>
        @endforeach    
        </div>
    </div>
</div>
@endsection
