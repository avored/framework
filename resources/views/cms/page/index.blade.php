@extends('avored-framework::layouts.app')

@section('content')
    <div class="container">
        <h1>
            <span class="main-title-wrap">{{ __('avored-framework::cms.page.list') }}</span>
            <a style="" href="{{ route('admin.page.create') }}" class="btn btn-primary float-right">{{ __('avored-framework::cms.page.create') }}</a>
        </h1>
        {!! DataGrid::render($dataGrid) !!}
    </div>

@stop
