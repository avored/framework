@extends('avored-framework::layouts.app')

@section('page-header')
    <div class="h1">
        {{ __('avored-framework::product.category.title') }}
        
        <a style="" href="{{ route('admin.category.create') }}" class="btn btn-primary float-right">
            {{ __('avored-framework::lang.category.index.create') }}
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
@stop
