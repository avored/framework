@extends('avored-framework::layouts.app')

@section('content')
    <div class="row mb-3">

        <div class="col-11">
            <div class="h1 float-left">
                {{  __('avored-framework::theme.theme-list') }}
            </div>
        </div>
        <div class="col-1">
            <div class="float-right">
                <a href="{{ route('admin.theme.create') }}"
                   class="btn btn-primary">
                    {{  __('avored-framework::theme.theme-upload') }}
                </a>
            </div>
        </div>
    </div>
    {!! DataGrid::render($dataGrid) !!}

@endsection

