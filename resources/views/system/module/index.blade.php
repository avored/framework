@extends('avored-framework::layouts.app')

@section('content')
    <div class="row mt-3">

        <div class="col-12">
            <div class="h1 float-left">
                {{  __('avored-framework::system.module-list') }}
            </div>
        
            <div class="float-right">
                <a href="{{ route('admin.module.create') }}"
                   class="btn btn-primary">
                    {{  __('avored-framework::system.module-upload') }}
                </a>
            </div>
        </div>
    </div>
    {!! DataGrid::render($dataGrid) !!}

@endsection

