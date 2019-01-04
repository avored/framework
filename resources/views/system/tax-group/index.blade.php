@extends('avored-framework::layouts.app')

@section('content')
<div class="container-fluid">
    <div class="h1">
        {{ __('avored-framework::system.tax-group.title') }}
        
        <a href="{{ route('admin.tax-group.create') }}" 
                class="float-right btn btn-primary">
            {{ __('avored-framework::system.tax-group.create') }}
        </a>
    </div>
    
    {!! DataGrid::render($dataGrid) !!}
      
</div>
@stop
