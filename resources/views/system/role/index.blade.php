@extends('avored-framework::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="h1">
        {{ __('avored-framework::role.role-list') }}
        <a href="{{ route('admin.role.create') }}" class="float-right btn btn-dark" title="{{ __('avored-framework::role.role-create') }}">
            {{ __('avored-framework::role.role-create') }}
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
</div>
@stop