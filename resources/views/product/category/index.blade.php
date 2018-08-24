@extends('avored-framework::layouts.app')

@section('content')
    <div class="h1">
        {{ __('avored-framework::lang.category.index.title') }}

        @hasPermission('admin.category.create')
           <a style="" href="{{ route('admin.category.create') }}" class="btn btn-primary float-right">
                {{ __('avored-framework::lang.category.index.create') }}
            </a>

            @elsehasPermission
                <button type="button" class="btn float-right" disabled>{{ __('avored-framework::lang.category.index.create') }} </button>
            @endhasPermission
    </div>

    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
@stop
