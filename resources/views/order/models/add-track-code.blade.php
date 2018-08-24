<div class="modal fade" id="add-track-code-model" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white bg-secondary">
                <h6 class="modal-title" id="exampleModalLabel">{{  __('avored-framework::orders.change-status') }}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>                        

            <form action="{{ route('admin.order.update-track-code', $order->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    
                    <div>
                        {{  __('avored-framework::orders.add-track-code-helper') }}
                    </div>
                    
                    <input type="hidden" name="_method" value="put">
                        @include('avored-framework::forms.text', 
                        ['name' => 'track_code',  'label' => 'Track Code'])
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success">
                        {{  __('avored-framework::orders.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>