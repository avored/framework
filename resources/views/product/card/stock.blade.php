        <div class="row" id="product-save-accordion" data-children=".product-card">
            <div class="col-12">
                <div class="card product-card">
                    <div class="card-body" id="basic">
                        <form>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-group col-md-8">
                                        <label>{{ __('avored-framework::product.stock.track') }}</label>
                                        <select name="track_stock" id="track_stock" class="form-control">
                                            <option value="1" selected="">Enbabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group col-md-7">
                                        <label for="min_stock">{{  __('avored-framework::product.stock.min') }}</label>
                                            <input type="number" name="min_stock" id="min_stock" value="" class="form-control" data-placement="bottom" title="{{  __('avored-framework::product.tooltips.min_stock') }}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group col-md-7">
                                        <label for="max_stock">{{  __('avored-framework::product.stock.max') }}</label>
                                            <input type="number" name="max_stock" id="max_stock" value="" class="form-control" data-placement="bottom" title="{{  __('avored-framework::product.tooltips.max_stock') }}">
                                    </div>
                                </div> 

                                <div class="col-md-3">
                                    <div class="form-group col-md-7">
                                        <label for="current_stock">{{  __('avored-framework::product.stock.stock') }}</label>
                                            <input type="number" name="qty" class="form-control" id="current_stock" value="{{ $model->qty }}" data-placement="bottom" title="{{  __('avored-framework::product.tooltips.current_stock') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

@push('scripts')
    <script>
        $(function () {
            $('input[type="text"]').tooltip();
            $('input[type="number"]').tooltip();            
            $('#track_stock').change(function() {
                if( $(this).val() == 0) {
                    $('#current_stock').prop("disabled", true);
                    $('#min_stock').prop("disabled", true).attr("value","0");
                    $('#max_stock').prop("disabled", true).attr("value","0");
                } else {
                    $('#current_stock').prop("disabled", false);
                    $('#min_stock').prop( "disabled", false);
                    $('#max_stock').prop( "disabled", false);
                }
            });
        });
    </script>
@endpush