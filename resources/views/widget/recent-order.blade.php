<div class="widget">
    <div class="card mb-3 d-block" style="cursor: move;">
        <div class="card-header">
            <h5 class="card-title text-center">{{ __('avored-framework::lang.admin-dashboard-recent-order-title') }}</h5>
        </div>
        <div class="card-body">
            @if(null === $recentOrderData)
                <p class="text-center">
                    Sorry There is no Order Data
                </p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>User</th>
                            <th>Products</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>{{ $recentOrderData['user'] }}</td>
                            <td>{{ $recentOrderData['product_count'] }}</td>
                            <td>{{ $recentOrderData['total_amount'] }}</td>
                        </tr>
                    </table>
                </div>

            @endif
            
        </div>
    </div>
</div>