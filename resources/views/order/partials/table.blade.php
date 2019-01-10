<div class="mt-3 card">
	<div class="card-body">
		<table class="table">
			<thead>
			<tr>
				<th>{{ __('avored-framework::lang.name') }}</th>
				<th>{{ __('avored-framework::lang.qty') }}</th>
				<th>{{ __('avored-framework::lang.price') }}</th>
				<th>Total</th>
			</tr>
			</thead>
			<tbody>
			@foreach($order->products as $product)
				@php
					$productInfo = json_decode($product->getRelationValue('pivot')->product_info);
				@endphp
				<tr>
					<td>
						{{ $productInfo->name }}

						@if($productInfo->type == "VARIATION")
							@foreach($order->orderProductVariation as $orderProductVariation)
								<p>
									{{ $orderProductVariation->attribute->name }}
									:
									{{   $orderProductVariation->attributeDropdownOption->display_text }}
								</p>

							@endforeach
						@endif

					</td>
					<td> {{ $product->getRelationValue('pivot')->qty }} </td>
					<td> {{ $product->getRelationValue('pivot')->price }} </td>
					<td> {{ $total = $product->getRelationValue('pivot')->price * $product->getRelationValue('pivot')->qty }} </td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
</div>
