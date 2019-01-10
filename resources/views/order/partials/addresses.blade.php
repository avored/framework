<div class="mt-3 card">
	<div class="card-header text-white bg-secondary">
		<span class="fa fa-user"></span>
		{{  __('avored-framework::orders.customer-data') }}
	</div>

	<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<h4>{{  __('avored-framework::orders.shipping-address') }}</h4>

				<p>
					{{ $order->shipping_address->first_name }} {{ $order->shipping_address->last_name }}
					<br/>
					{{ $order->shipping_address->address1 }}<br/>
					{{ $order->shipping_address->address2 }}<br/>
					{{ $order->shipping_address->area }}<br/>
					{{ $order->shipping_address->city }}<br/>
					{{ $order->shipping_address->state }} {{ $order->shipping_address->country->name }}
					<br/>
					{{ $order->shipping_address->phone }}<br/>
				</p>
			</div>
			<div class="col-md-6">
				<h4>{{  __('avored-framework::orders.billing-address') }}</h4>

				<p>
					{{ $order->billing_address->first_name }} {{ $order->shipping_address->last_name }}
					<br/>
					{{ $order->billing_address->address1 }}<br/>
					{{ $order->billing_address->address2 }}<br/>
					{{ $order->billing_address->area }}<br/>
					{{ $order->billing_address->city }}<br/>
					{{ $order->billing_address->state }} {{ $order->shipping_address->country->name }}
					<br/>
					{{ $order->billing_address->phone }}<br/>
				</p>
			</div>
		</div>
	</div>
</div>
