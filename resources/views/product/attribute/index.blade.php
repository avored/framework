@extends('avored-framework::layouts.app')

@section('content')

        <h1>
            <span class="main-title-wrap">{{ __('avored-framework::attribute.list') }}</span>
            <a style="" href="{{ route('admin.attribute.create') }}"
               class="btn btn-primary float-right">
                {{ __('avored-framework::attribute.create') }}
            </a>
        </h1>
        {!! DataGrid::render($dataGrid) !!}


@stop
