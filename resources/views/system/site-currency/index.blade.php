@extends('avored-framework::layouts.app')

@section('content')
    <div class="h1">
        {{ __('avored-framework::currency.title') }}
        <a href="{{ route('admin.site-currency.create') }}" class="float-right btn btn-default bg-dark">{{ __('avored-framework::currency.create') }}</a>
    </div>

    <div class="card">
    	<div class="card-body">
    		{!! DataGrid::render($dataGrid) !!}
    	</div>
    </div>
@stop
