@extends('avored-framework::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="h1">
        {{ __('avored-framework::system.country-list') }}
        
        <a href="{{ route('admin.country.create') }}" 
                class="float-right btn btn-primary">
            {{ __('avored-framework::system.country-create') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
</div>
@stop
