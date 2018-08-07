@extends('avored-framework::layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="h1">Orders</div>
        {!! DataGrid::render($dataGrid) !!}
    </div>
@stop
