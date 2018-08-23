@extends('avored-framework::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="h1">
        {{ __('avored-framework::user.user-list') }}
        <a href="{{ route('admin.user.create') }}" class="float-right btn btn-dark" 
                title="{{ __('avored-framework::user.user-create') }}">
            {{ __('avored-framework::user.user-create') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
</div>
@stop