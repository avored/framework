<!-- Modal -->
<div class="modal fade" id="CreateProductModal" tabindex="-1" role="dialog" aria-labelledby="CreateProductModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form id="product-save-form" action="{{ route('admin.product.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="CreateProductModalLabel">{{ __('avored-framework::product.create.product') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                @include("avored-framework::forms.text", ['name'=> 'name', 'label' => __('avored-framework::product.name')])
                @include("avored-framework::forms.select",
                    ['name'=> 'type', 'label' => 'Type',
                        'options' => [ 
                            'BASIC' => __('avored-framework::product.types.basic'),
                            'DOWNLOADABLE' => __('avored-framework::product.types.digital'),
                            'VARIATION' => __('avored-framework::product.types.variation')
                            ]
                        ])

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{ __('avored-framework::product.create.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>