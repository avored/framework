@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::catalog.category.index.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::catalog.category.index.title') }}
@endsection

@section('content')
<a-row type="flex" class="mb-1" justify="end">
    <a-col>
        <a 
            href="{{ route('admin.category.create') }}"
            class="ant-btn ant-btn-primary">
            <a-icon type="plus"></a-icon>
            {{ __('avored::system.btn.create') }}
        </a>
    </a-col>
</a-row>

<div>
    <category-table
        :category-data="{{ json_encode($categories) }}"
        base-url="{{ asset(config('avored.admin_url')) }}"
    ></category-table>
</div>

@endsection
