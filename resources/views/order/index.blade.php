@extends('avored-framework::layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="h1">{{  __('avored-framework::orders.orders-index') }}</div>

        <div class="card">
        	<div class="card-body">
        		{!! DataGrid::render($dataGrid) !!}
        	</div>
        </div>        
    </div>
@stop
