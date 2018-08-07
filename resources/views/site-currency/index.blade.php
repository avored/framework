@extends('avored-framework::layouts.app')

@section('content')

    <div class="h1">
        {{ __('avored-framework::currency.title') }}

            <a href="{{ route('admin.site-currency.create') }}"
                class="float-right btn btn-primary">
                {{ __('avored-framework::currency.create') }}
            </a>

    </div>
    {!! DataGrid::render($dataGrid) !!}

@stop
