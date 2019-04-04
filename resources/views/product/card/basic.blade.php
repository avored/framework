<div class="row">
    <div class="col-6">
        @include('avored-framework::forms.text',['name' => 'name','label' => 'Name'])
    </div>
    <div class="col-6">
        @if(!isset($productCategories))
            <?php $productCategories = []; ?>
        @endif

        <div class="form-group">
            <label>Category</label>
            <multiselect
                v-model="category_multiselect_values"
                @select="categorySelected"
                label="name"
                :searchable="true"
                track-by="id" 
                :close-on-select="true" :clear-on-select="true" :preserve-search="false"
                :multiple="true"
                :options="{{ $categoryOptions }}"
            >
                <template slot="tag" slot-scope="{ option }">
                    <span class="multiselect__tag">
                        @{{ option.name }}
                    </span>
                </template>
            </multiselect>
            <input type="hidden" name="category_id[]" v-model="category_id" />
            
        </div>

    </div>
</div>


<div class="row">
    <div class="col-6">
        @include('avored-framework::forms.text',['name' => 'slug','label' => 'Slug'])
    </div>
    <div class="col-6">
        @include('avored-framework::forms.text',['name' => 'sku','label' => 'Sku'])
    </div>
</div>

<markdown-editor value="{{ (isset($product)) ? $product->description : '' }}" name="description"></markdown-editor>

<div class="row">
    @if($model->type == "VARIATION")
        <div class="col-6">
            @include('avored-framework::forms.text',['name' => 'price','label' => 'Base Price'])
        </div>
    @else
        <div class="col-6">
            @include('avored-framework::forms.text',['name' => 'price','label' => 'Price'])
        </div>
    @endif
        <div class="col-6">
            @include('avored-framework::forms.text',['name' => 'cost_price','label' => 'Cost Price'])
        </div>
    </div>


<div class="row">
    <div class="col-6">
        @include('avored-framework::forms.text',['name' => 'qty','label' => 'Qty'])
    </div>
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'in_stock','label' => 'In Stock', 'options' => ['1' => 'Enabled','0' => 'Disabled']])
    </div>
</div>

<div class="row">
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'track_stock','label' => 'Track Stock', 'options' => ['1' => 'Enabled','0' => 'Disabled']])

    </div>
    <div class="col-6">
        @include('avored-framework::forms.select',['name' => 'is_taxable','label' => 'Is taxable', 'options' => ['1' => 'Enabled','0' => 'Disabled']])
    </div>
</div>


@if($model->type !== "DOWNLOADABLE")
<div class="row">
    <div class="col-md-6">
        @include('avored-framework::forms.text',['name' => 'weight','label' => 'Weight'])
    </div>
    <div class="col-md-6">
        @include('avored-framework::forms.select',['name' => 'status','label' => 'Status', 'options' => ['1' => 'Enabled','0' => 'Disabled']])
    </div>
    
    
</div>

<div class="row">
    <div class="col-md-4">
        @include('avored-framework::forms.text',['name' => 'width','label' => 'Width'])
    </div>
    <div class="col-4">
        @include('avored-framework::forms.text',['name' => 'height','label' => 'height'])
    </div>
    <div class="col-4">
        @include('avored-framework::forms.text',['name' => 'length','label' => 'Length'])
    </div>

</div>
@endif
