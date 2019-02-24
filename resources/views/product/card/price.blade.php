        <div class="row" id="product-save-accordion" data-children=".product-card">
            <div class="col-12">
                <div class="card product-card">
                    <div class="card-body" id="basic">                        
                        <form>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-group col-md-8">
                                        <label for="inlineFormInputGroup">{{  __('avored-framework::product.purchase_price') }}</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">€</div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroup" value="{{ $model->purchase_price }}" data-placement="bottom" title="{{  __('avored-framework::product.tooltips.purchase_price') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group col-md-8">
                                        <label for="cost_price">{{  __('avored-framework::product.sales_price') }}</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">€</div>
                                            </div>
                                            <input type="text" class="form-control" id="cost_price" value="{{ $model->price }}" data-placement="bottom" title="{{  __('avored-framework::product.tooltips.sales_price') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group col-md-8">
                                        <label for="cost_price">{{  __('avored-framework::product.discount') }}</label>
                                            <input type="text" class="form-control" id="cost_price" value="{{ $model->discount }}" data-placement="bottom" title="{{  __('avored-framework::product.tooltips.discount') }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group col-md-8">
                                         @include('avored-framework::forms.select',['name' => 'is_taxable','label' => __('avored-framework::product.taxable'), 'options' => ['1' => 'Enabled','0' => 'Disabled']])
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
        });
    </script>
@endpush