@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::order.order.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::order.order.index.title') }}
@endsection

@section('content')


<div>
    <order-table
        :init-orders="{{ json_encode($orders) }}"
        base-url="{{ asset(config('avored.admin_url')) }}"
    ></order-table>
</div>
@endsection
