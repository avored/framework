@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::promotion.promotion-code.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::promotion.promotion-code.index.title') }}
@endsection

@section('content')
<promotion-code-table
    :init-promotion-codes="{{ json_encode($promotionCodes) }}"
    create-url="{{ route('admin.promotion-code.create') }}"
    base-url="{{ asset(config('avored.admin_url')) }}"
></promotion-code-table>
@endsection
