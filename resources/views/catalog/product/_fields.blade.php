<a-card title="{{ __('avored::catalog.product.basic_card_title') }}">
 <a-row :gutter="15" type="flex">
    <a-col :span="12">
    
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::system.fields.name') }}"
                field-name="name"
                init-value="{{ $product->name ?? '' }}" 
                error-text="{{ $errors->first('name') }}"
            >
            </avored-input>
        </div>

    </a-col>


    <a-col :span="12">
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::system.fields.slug') }}"
                field-name="slug"
                init-value="{{ $product->slug ?? '' }}" 
                error-text="{{ $errors->first('slug') }}"
            >
            </avored-input>
        </div>

    </a-col>

</a-row>
<?php
//dd();
?>
<a-row type="flex" :gutter="15">
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('category'))
                validate-status="error"
                help="{{ $errors->first('category') }}"
            @endif
            label="{{ __('avored::catalog.product.category') }}">

            <a-select
                mode="multiple"
                @change="handleCategoryChange"
                v-decorator="[
                'category',
                {{ ($product->categories !== null && count($product->categories) > 0) ? "{'initialValue': [\"". implode('","', $product->categories->pluck('id')->toArray()) . "\"]}," : "" }}
                {rules:
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'Categories']) }}' 
                        }
                    ]
                }
                ]">
                @foreach ($categoryOptions as $catVal => $catLabel)
                    <a-select-option
                      value="{{ $catVal }}">{{ $catLabel }}</a-select-option>
                @endforeach
            </a-select>
        </a-form-item>
        <span v-for="(category, index) in categories">
            <input name="category[]" :value="category" type="hidden" />
        </span>
    </a-col>
     <a-col :span="12">
        <a-form-item
            @if ($errors->has('type'))
                validate-status="error"
                help="{{ $errors->first('type') }}"
            @endif
            label="{{ __('avored::catalog.product.type') }}">

            <a-select
                @change="handleTypeChange"
                disabled
                v-decorator="[
                'type',
                {{ ($product->type !== '') ? "{'initialValue': '" . $product->type . "'}," : "" }}
                {rules:
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'Type']) }}' 
                        }
                    ]
                }
                ]">
                @foreach ($typeOptions as $typeVal => $typeLabel)
                    <a-select-option
                      value="{{ $typeVal }}">{{ $typeLabel }}</a-select-option>
                @endforeach
            </a-select>
        </a-form-item>
        <input name="type" v-model="type" type="hidden" />
    
    </a-col>
</a-row>


<a-row :gutter="15" type="flex">
    <a-col :span="12">
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::system.fields.sku') }}"
                field-name="sku"
                init-value="{{ $product->sku ?? '' }}" 
                error-text="{{ $errors->first('sku') }}"
            >
            </avored-input>
        </div>

    </a-col>

    <a-col :span="12">
        <avored-input
                label-text="{{ __('avored::system.fields.barcode') }}"
                field-name="barcode"
                init-value="{{ $product->barcode ?? '' }}" 
                error-text="{{ $errors->first('barcode') }}"
            >
            </avored-input>
    </a-col>
</a-row>

<div class="ant-row ant-form-item">
    <div class="ant-form-item-label">
        <label for="product-description" title="{{ __('avored::cms.product.description') }}">
            {{ __('avored::catalog.product.description') }}
        </label>
    </div>
    
    <div class="ant-form-item-control-wrapper">
        <div class="ant-form-item-control">
            <quil-editor id="product-description" v-model="description"></quil-editor>
            <input type="hidden" name="description" v-model="description" />
        </div>
    </div>
</div>


<a-row :gutter="15" type="flex">
    <a-col :span="12">
        <avored-input
            label-text="{{ __('avored::system.fields.qty') }}"
            field-name="qty"
            init-value="{{ $product->qty ?? '' }}" 
            error-text="{{ $errors->first('qty') }}"
        >
        </avored-input>
    </a-col>

    <a-col :span="12">
        <div class="mt-3 flex w-full">
            <avored-toggle
                label-text="{{ __('avored::system.fields.status') }}"
                error-text="{{ $errors->first('status') }}"
                field-name="status"
                init-value="{{ $product->status ?? '' }}"
            >
            </avored-toggle>
        </div>
        
    </a-col>
</a-row>

<a-row :gutter="15" type="flex">
    <a-col :span="12">

        <avored-toggle
            label-text="{{ __('avored::system.fields.track_stock') }}"
            error-text="{{ $errors->first('track_stock') }}"
            field-name="track_stock"
            init-value="{{ $product->track_stock ?? '' }}"
        >
        </avored-toggle>

    </a-col>

    <a-col :span="12">

        <avored-toggle
            label-text="{{ __('avored::system.fields.is_taxable') }}"
            error-text="{{ $errors->first('is_taxable') }}"
            field-name="is_taxable"
            init-value="{{ $product->is_taxable ?? '' }}"
        >
        </avored-toggle>

    </a-col>
</a-row>

<a-row :gutter="15" class="mt-3" type="flex">
    <a-col :span="12">
        <avored-input
            label-text="{{ __('avored::system.fields.price') }}"
            field-name="price"
            init-value="{{ $product->price ?? '' }}" 
            error-text="{{ $errors->first('price') }}"
        >
        </avored-input>
    </a-col>


    <a-col :span="12">
        <avored-input
            label-text="{{ __('avored::system.fields.cost_price') }}"
            field-name="cost_price"
            init-value="{{ $product->cost_price ?? '' }}" 
            error-text="{{ $errors->first('cost_price') }}"
        >
        </avored-input>
    </a-col>

</a-row>


<a-row :gutter="15" class="mt-3" type="flex">
    <a-col :span="6">
        <avored-input
            label-text="{{ __('avored::system.fields.length') }}"
            field-name="length"
            init-value="{{ $product->length ?? '' }}" 
            error-text="{{ $errors->first('length') }}"
        >
        </avored-input>
    </a-col>


    <a-col :span="6">
        <avored-input
            label-text="{{ __('avored::system.fields.width') }}"
            field-name="width"
            init-value="{{ $product->width ?? '' }}" 
            error-text="{{ $errors->first('width') }}"
        >
        </avored-input>
    </a-col>
    <a-col :span="6">
        <avored-input
            label-text="{{ __('avored::system.fields.height') }}"
            field-name="height"
            init-value="{{ $product->height ?? '' }}" 
            error-text="{{ $errors->first('height') }}"
        >
        </avored-input>
    </a-col>
    <a-col :span="6">
        <avored-input
            label-text="{{ __('avored::system.fields.weight') }}"
            field-name="weight"
            init-value="{{ $product->weight ?? '' }}" 
            error-text="{{ $errors->first('weight') }}"
        >
        </avored-input>
    </a-col>
</a-form-item>

</a-row>

<div class="mt-3">
    <avored-input
        label-text="{{ __('avored::system.fields.meta_title') }}"
        field-name="meta_title"
        init-value="{{ $product->meta_title ?? '' }}" 
        error-text="{{ $errors->first('meta_title') }}"
    >
    </avored-input>
</div>

<div class="mt-3">
    <avored-input
        label-text="{{ __('avored::system.fields.meta_description') }}"
        field-name="meta_description"
        init-value="{{ $product->meta_description ?? '' }}" 
        error-text="{{ $errors->first('meta_description') }}"
    >
    </avored-input>
</div>

</a-card>
