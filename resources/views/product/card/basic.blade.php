<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="name">{{ __('avored-framework::product.name') }}</label>
            <input type="text"
                name="name"
                value="{{ (isset($product)) ? $product->name : '' }}"
                class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                id="name" />
                @if ($errors->has('name'))
                <span class='invalid-feedback'>
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label>Category</label>
            <multiselect
                v-model="categories"
                @select="categorySelected"
                label="name"
                :searchable="true"
                track-by="id" 
                :close-on-select="true"
                :clear-on-select="true"
                :preserve-search="false"
                :multiple="true"
                :options="{{ $categoryOptions }}"
            >
                <template slot="tag" slot-scope="{ option }">
                    <span class="multiselect__tag">
                        @{{ option.name }}
                    </span>
                </template>
            </multiselect>
            <div v-for="category in category_id">
                <input type="hidden" name="category_id[]" v-model="category.value" />
            </div>
            
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
    @if($product->type == "VARIATION")
        <div class="col-6">
            <div class="form-group">
                <label for="price">{{ __('avored-framework::product.base_price') }}</label>
                <input type="text"
                    name="price"
                    class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                    id="price" />
                    @if ($errors->has('price'))
                    <span class='invalid-feedback'>
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @else
        <div class="col-6">
            <div class="form-group">
                <label for="price">{{ __('avored-framework::product.price') }}</label>
                <input type="text"
                    name="price"
                    class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}"
                    id="price" />
                    @if ($errors->has('price'))
                    <span class='invalid-feedback'>
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    @endif
        <div class="col-6">
            <div class="form-group">
                <label for="cost_price">{{ __('avored-framework::product.cost_price') }}</label>
                <input type="text"
                    name="cost_price"
                    class="form-control {{ $errors->has('cost_price') ? ' is-invalid' : '' }}"
                    id="cost_price" />
                    @if ($errors->has('cost_price'))
                    <span class='invalid-feedback'>
                        <strong>{{ $errors->first('cost_price') }}</strong>
                    </span>
                @endif
            </div>
        </div>
    </div>


<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="qty">{{ __('Qty') }}</label>
            <input type="text"
                name="qty"
                class="form-control {{ $errors->has('qty') ? ' is-invalid' : '' }}"
                id="qty" />
                @if ($errors->has('qty'))
                <span class='invalid-feedback'>
                    <strong>{{ $errors->first('qty') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="in_stock">{{ __('avored-framework::product.in_stock') }}</label>
            <select
                name="in_stock"
                class="form-control {{ $errors->has('in_stock') ? ' is-invalid' : '' }}"
                id="in_stock"
            >
                
                <option value="1">{{ __('avored-framework::product.yes') }}</option>
                <option value="0">{{ __('avored-framework::product.no') }}</option>
               
            </select>
                @if ($errors->has('in_stock'))
                <span class='invalid-feedback'>
                    <strong>{{ $errors->first('in_stock') }}</strong>
                </span>
            @endif
        </div>
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


@if($product->type !== "DOWNLOADABLE")
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
