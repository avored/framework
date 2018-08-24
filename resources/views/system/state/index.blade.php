@extends('avored-framework::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="h1">
        {{ __('avored-framework::system.state-list') }}
        
        <a href="{{ route('admin.state.create') }}" 
                class="float-right btn btn-primary">
            {{ __('avored-framework::system.state-create') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
</div>
@stop
