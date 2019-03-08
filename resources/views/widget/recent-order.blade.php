<div class="card">
    <div class="card-header bg-white">{{ __('avored-framework::lang.admin-dashboard-recent-order-title') }}</div>
    <div class="card-body">
        @if(null === $recentOrderData)
            <p class="text-center">Sorry There is no Order Data</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordeblue table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">{{ __('avored-framework::customer.title') }}</th>
                            <th class="text-center">{{ __('avored-framework::orders.products') }}</th>
                            <th class="text-center">{{ __('avored-framework::orders.total') }}</th>
                            <th class="text-center">{{ __('avored-framework::orders.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">
                                <a href="{{Route('admin.order.view', $recentOrderData['order_id'])}}">{{ $recentOrderData['user'] }}</a>
                            </td>
                            <td class="text-center">{{ $recentOrderData['product_count'] }}</td>
                            <td class="text-center">{{ $recentOrderData['total_amount'] }}</td>
                            <td class="text-center">{{ $recentOrderData['status'] }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>