<div class="modal"
     id="variation-modal-{{ $model->id }}"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::open()->fill($model)->route('admin.product.update', [$model->id])->multipart()->put() !!}
            {!! Form::hidden('product_id', $model->id) !!}
            <div class="modal-header">
                <h5 class="modal-title">Variação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                Atribute
                {!! $model->productIntegerAttributes !!}

                {!! Form::text('name', __('avored-framework::lang.name'))->id('variation-name-' . $model->id) !!}
                {!! Form::text('sku', 'SKU')->id('variation-sku-' . $model->id) !!}
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('price', __('avored-framework::lang.price'))->id('variation-price-' . $model->id) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('qty', __('avored-framework::lang.qty'))->id('variation-qty-' . $model->id) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        {!! Form::text('width', __('avored-framework::product.basic.width'))->id('variation-width-' . $model->id) !!}
                        {!! Form::text('height', __('avored-framework::product.basic.height'))->id('variation-height-' . $model->id) !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::text('length', __('avored-framework::product.basic.length'))->id('variation-length-' . $model->id) !!}
                        {!! Form::text('weight', __('avored-framework::product.basic.weight'))->id('variation-weight-' . $model->id) !!}
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::text('image', 'Imagem da Variação')->type('file') !!}
                        </div>
                        @if (count($model->images))
                            <div class="col-md-6">
                               Atual: <br />
                                <img class="img-thumbnail img-tag img-responsive" src="{{ $model->image->smallUrl }}"/>
                                <br />
                                <small>O upload de uma nova imagem fará a substituição da foto acima.</small>
                            </div>
                        @endif
                    </div>



            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary save-variation-button">Salvar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
