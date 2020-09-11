@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.customer')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.customer')]) }}
        </div>
    </div>
@endsection

@section('content')

<div>
    <customer-table
        :init-customers="{{ json_encode($customers) }}"
        base-url="{{ asset(config('avored.admin_url')) }}"
    ></customer-table>
</div>
@endsection
