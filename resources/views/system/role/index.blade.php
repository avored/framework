@extends('avored-framework::layouts.app')

@section('content')

    <div class="container">
        <div class="h1">
            {{ __('avored-framework::role.role-list') }}

                <a href="{{ route('admin.role.create') }}"
                   class="float-right btn btn-primary"
                    title="{{ __('avored-framework::role.role-create') }}"
                >
                    {{ __('avored-framework::role.role-create') }}
                </a>

        </div>

        {!! DataGrid::render($dataGrid) !!}
    </div>
@stop