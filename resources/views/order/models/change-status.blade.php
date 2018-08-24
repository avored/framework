<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-secondary">
                <h6 class="modal-title" id="exampleModalLabel">{{  __('avored-framework::orders.change-status') }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                        

            <form action="{{ route('admin.order.update-status', $order->id) }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div>
                        {{  __('avored-framework::orders.change-status-helper') }}
                    </div>
                    
                    <input type="hidden" name="_method" value="put">
                        @include('avored-framework::forms.select', 
                        ['name' => 'order_status_id',  'label' => '', 'options' => $orderStatus])
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success">{{  __('avored-framework::orders.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>