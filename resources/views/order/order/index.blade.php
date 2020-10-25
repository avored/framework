@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.order')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.order')]) }}
        </div>
    </div>
@endsection

@section('content')
<order-table
    :init-orders="{{ json_encode($orders) }}"
    :order-statuses="{{ json_encode($orderStatuses) }}"
    filter-url="{{ route('admin.order.filter') }}"
    base-url="{{ asset(config('avored.admin_url')) }}"
></order-table>
@endsection
