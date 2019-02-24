@extends('avored-framework::layouts.app')

@section('content')
    <div class="row">
    	<div class="col-md-12">
    		<h2 class="align-left">{{ __('avored-framework::lang.product.index.title') }}</h2>
    		<div class="btn-group float-right" role="group">
    			<a href="#" data-toggle="modal" data-target="#CreateProductModal" class="btn btn-primary"><i class="fas fa-plus"></i> {{ __('avored-framework::lang.product.create.text') }}</a>
    			<a href="#" class="btn btn-primary"><i class="fas fa-file-import"></i> {{ __('avored-framework::product.import') }}</a>
    			<a href="{{ route('admin.product.export') }}" class="btn btn-primary"><i class="fas fa-file-export"></i> {{ __('avored-framework::product.export') }}</a>	
    		</div>
    	</div>
    </div>

    @include('avored-framework::product.create')

    <div class="row">
    	<div class="col-md-12">
    		{!! DataGrid::render($dataGrid) !!}
    	</div>
    </div>
@stop
