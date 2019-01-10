@extends('avored-framework::layouts.app')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="main-title-wrap">
				<div class='h2'>
					{{  __('avored-framework::orders.order-details') }} (#{{ $order->id }})

					@if($order->orderStatus->name === "Delivered")
						<small><span class="badge badge-success">{{ $order->orderStatus->name }}</span></small>
					@else
						<small><span class="badge badge-info">{{ $order->orderStatus->name }}</span></small>
					@endif

					<div class="float-right">
						<button type="button" data-toggle="modal" data-target="#changeModal"
								class="btn btn-dark">{{  __('avored-framework::orders.change-status') }}</button>
						<button type="button"
								data-toggle="modal"
								data-target="#add-track-code-model"
								class="btn btn-dark">
							{{  __('avored-framework::orders.add-track-code') }}
						</button>

						<a href="{{ route('admin.order.send-email-invoice', $order->id) }}"
						   class="btn btn-dark">{{  __('avored-framework::orders.send-invoice') }}</a>

					</div>
				</div>


				<div class="clearfix"></div>


				@include('avored-framework::order.partials.addresses', ['order' => $order])
				@include('avored-framework::order.partials.table', ['order' => $order])
				@include('avored-framework::order.partials.other_data', ['order' => $order])
				@include('avored-framework::order.partials.history', ['order' => $order])


			</div>
		</div>
	</div>

	@include('avored-framework::order.models.add-track-code')
	@include('avored-framework::order.models.change-status')
@endsection

