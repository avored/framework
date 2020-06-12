@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.category.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.category.index.title') }}
@endsection

@section('content')

<category-table
    :init-categories="{{ json_encode($categories) }}"
    create-url="{{ route('admin.category.create') }}"
    base-url="{{ asset(config('avored.admin_url')) }}"
></category-table>

@endsection
