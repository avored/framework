@extends('avored-framework::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="h1">
        {{ __('avored-framework::system.language.title') }}
        
        <a href="{{ route('admin.language.create') }}" 
                class="float-right btn btn-primary">
            {{ __('avored-framework::system.language.create') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
</div>
@stop
