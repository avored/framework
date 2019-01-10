
<div class="mt-3 card">
	<div class="card-header text-white bg-secondary"><span
				class="fa fa-history"></span> {{  __('avored-framework::orders.history') }}</div>
	<div class="card-body">
		<table class="table table-striped">
			<thead>
			<tr>
				<th scope="col">{{  __('avored-framework::orders.history-action') }}</th>
				<th scope="col">{{  __('avored-framework::orders.history-updated-at') }}</th>
				<th scope="col">Dados</th>
			</tr>
			</thead>
			@foreach($order->history as $orderHistory)
				<tbody>
				<tr>
					<td>O status do pedido foi alterado para
						<strong>{{ $orderHistory->orderStatus->name }}</strong></td>
					<td>{{ $orderHistory->updated_at->format('d/m/Y H:i:s') }}
						- {!! $orderHistory->updated_at->diffForHumans() !!} </td>
					<td>{!! $orderHistory->transaction_data !!}</td>
				</tr>
				</tbody>
			@endforeach
		</table>
	</div>
</div>
