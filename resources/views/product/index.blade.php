@extends('avored-framework::layouts.app')

@section('content')
    <h1>
		<span class="main-title-wrap">{{ __('avored-framework::lang.product.index.title') }}</span>
		<div class="btn-group float-right" role="group">
			<a style="" href="{{ route('admin.product.create') }}" class="btn btn-primary">
				{{ __('avored-framework::lang.product.create.text') }}
			</a>

			<div class="btn-group" role="group">
				<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				
				</button>
				<div class="dropdown-menu extra-product-link" aria-labelledby="btnGroupDrop1">
				<!--a class="dropdown-item" href="#">Import Product</a-->
				<a class="dropdown-item" href="{{ route('admin.product.export') }}">Export Product</a>
				</div>
			</div>
		</div>
    	
    </h1>
	{!! DataGrid::render($dataGrid) !!}
    
@stop
