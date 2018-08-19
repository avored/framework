@extends('avored-framework::layouts.app')

@section('content')
    <h1>
    	<span class="main-title-wrap">{{ __('avored-framework::lang.product.index.title') }}</span>
    	<a style="" href="{{ route('admin.product.create') }}" class="btn btn-primary float-right">
    		{{ __('avored-framework::lang.product.create.text') }}
         </a>
    </h1>


    <div class="card">
    	<div class="card-body">
      		{!! DataGrid::render($dataGrid) !!}
      	</div>
      </div>
@stop
