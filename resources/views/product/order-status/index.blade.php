@extends('avored-framework::layouts.app')

@section('content')
    <div class="h1">
        {{ __('avored-framework::shop.order-status-list') }}

        @hasPermission('admin.order-status.create')
           <a style="" href="{{ route('admin.order-status.create') }}" class="btn btn-primary float-right">
                {{ __('avored-framework::shop.order-status-create') }}
            </a>

            @elsehasPermission
                <button type="button" class="btn float-right" disabled>
                    {{ __('avored-framework::shop.order-status-create') }} 
                </button>
            @endhasPermission
    </div>

    <div class="card">
        <div class="card-body">
            {!! DataGrid::render($dataGrid) !!}
        </div>
    </div>
@stop
