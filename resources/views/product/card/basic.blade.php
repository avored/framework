<div class="row">
    <div class="col-6">
        @include('avored-framework::forms.text',['name' => 'name','label' => __('avored-framework::product.name')])
    </div>
    <div class="col-6">
        @if(!isset($productCategories))
            <?php $productCategories = []; ?>
        @endif

        @include('avored-framework::forms.select2',['name' => 'category_id[]',
                                                'label' => __('avored-framework::product.category_name'),
                                                'attributes' => ['class' => 'form-control select2',
                                                                'id' => 'category_id',
                                                                'multiple' => true,
                                                                ],
                                                'options' => $categoryOptions,
                                                'values' => $productCategories])


    </div>
</div>


<div class="row">
    <div class="col-6">
        {!! Form::text('slug', 'Slug')->required() !!}
    </div>
    <div class="col-6">
        {!! Form::text('sku', 'SKU')->required() !!}
    </div>
</div>

{!! Form::textarea('description', 'Description')->attrs(['class' => 'summernote'])->id('description')->required() !!}

<div class="row">
    @if($model->type == "VARIATION")
        <div class="col-6">
            {!! Form::text('price' , __('avored-framework::product.basic.base_price'))->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true']) !!}
        </div>
    @else
        <div class="col-6">
            {!! Form::text('price' , __('avored-framework::lang.price'))->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true'])->required() !!}
        </div>
    @endif
    <div class="col-6">
        {!! Form::text('cost_price' , __('avored-framework::product.basic.cost_price'))->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true'])->required() !!}
        {!! Form::text('regular_price' , 'Preço de Varejo')->attrs(['data-mask' => '##9.99', 'data-mask-reverse' => 'true'])->required() !!}
    </div>
</div>


<div class="row">
    <div class="col-6">
        {!! Form::text('qty', __('avored-framework::product.basic.qty'))->type('number') !!}
    </div>
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'in_stock','label' => __('avored-framework::product.basic.in_stock'), 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])
    </div>
</div>

<div class="row">
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'track_stock','label' => 'Track Stock', 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])

    </div>
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'is_taxable','label' => __('avored-framework::product.basic.is_taxable'), 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])
    </div>
</div>


@if($model->type !== "DOWNLOADABLE")
    <div class="row">
        <div class="col-md-6">
            @include('avored-framework::forms.text',['name' => 'weight','label' =>  __('avored-framework::product.basic.weight')])
        </div>
        <div class="col-md-6">
            @include('avored-framework::forms.select',['name' => 'status','label' => 'Status', 'options' => ['1' => __('avored-framework::lang.enabled'),'0' => __('avored-framework::lang.disabled')]])
        </div>


    </div>

    <div class="row">
        <div class="col-md-4">
            {!! Form::text('width', __('avored-framework::product.basic.width'))->required() !!}
        </div>
        <div class="col-md-4">
            {!! Form::text('height', __('avored-framework::product.basic.height'))->required() !!}
        </div>
        <div class="col-md-4">
            {!! Form::text('length', __('avored-framework::product.basic.length'))->required() !!}
        </div>
    </div>
@endif
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({element: document.getElementById("description")});
    </script>
@endpush
