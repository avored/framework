<a-card title="{{ __('avored::catalog.product.basic_card_title') }}">
 <a-row :gutter="15" type="flex">
    <a-col :span="12">
    
        <a-form-item
            @if ($errors->has('name'))
                validate-status="error"
                help="{{ $errors->first('name') }}"
            @endif
            label="{{ __('avored::catalog.product.name') }}">
            <a-input
                :auto-focus="true"
                name="name"
                v-decorator="[
                'name',
                {{ ($product->name !== '') ? "{'initialValue': '" . $product->name . "'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>


    <a-col :span="12">
        <a-form-item
            @if ($errors->has('slug'))
                validate-status="error"
                help="{{ $errors->first('slug') }}"
            @endif
            label="{{ __('avored::catalog.product.slug') }}">
            <a-input
                name="slug"
                v-decorator="[
                'slug',
                {{ ($product->slug !== '') ? "{'initialValue': '" . $product->slug . "'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'Slug']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>

        </a-form-item>
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
        <a-form-item
            @if ($errors->has('sku'))
                validate-status="error"
                help="{{ $errors->first('sku') }}"
            @endif
            label="{{ __('avored::catalog.product.sku') }}">
            <a-input
                name="sku"
                v-decorator="[
                'sku',
                {{ ($product->sku !== '') ? "{'initialValue': '" . $product->sku . "'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'SKU']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>

    <a-col :span="12">
        <a-form-item
            @if ($errors->has('barcode'))
                validate-status="error"
                help="{{ $errors->first('barcode') }}"
            @endif
            label="{{ __('avored::catalog.product.barcode') }}">
            <a-input
            
                name="barcode"
                v-decorator="[
                'barcode',
                {{ ($product->barcode !== '') ? "{'initialValue': '" . $product->barcode . "'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'Barcode']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>

        </a-form-item>
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
        <a-form-item
            @if ($errors->has('qty'))
                validate-status="error"
                help="{{ $errors->first('qty') }}"
            @endif
            label="{{ __('avored::catalog.product.qty') }}">
            <a-input
                name="qty"
                v-decorator="[
                'qty',
                {{ ($product->qty !== '') ? "{'initialValue': '" . $product->qty . "'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'Qty']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>

    <a-col :span="12">
        <a-form-item
            @if ($errors->has('status'))
                validate-status="error"
                help="{{ $errors->first('status') }}"
            @endif
            label="{{ __('avored::catalog.product.status') }}">
            
            <a-switch 
                @if ($product->status)
                    default-checked
                @endif
                @change="handleStatusChange"></a-switch>
        </a-form-item>
        <input type="hidden" name="status" v-model="status" />
    </a-col>
</a-row>

<a-row :gutter="15" type="flex">
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('track_stock'))
                validate-status="error"
                help="{{ $errors->first('track_stock') }}"
            @endif
            label="{{ __('avored::catalog.product.track_stock') }}">
            
            <a-switch
                @if ($product->track_stock)
                    default-checked
                @endif
                @change="handleTrackStockChange"></a-switch>
        </a-form-item>
        <input type="hidden" name="track_stock" v-model="track_stock" />
    </a-col>

    <a-col :span="12">
        <a-form-item
            @if ($errors->has('is_taxable'))
                validate-status="error"
                help="{{ $errors->first('is_taxable') }}"
            @endif
            label="{{ __('avored::catalog.product.is_taxable') }}">
            
            <a-switch
                @if ($product->is_taxable)
                    default-checked
                @endif
                @change="handleIsTaxableChange"></a-switch>
        </a-form-item>
        <input type="hidden" name="is_taxable" v-model="is_taxable" />
    </a-col>
</a-row>

<a-row :gutter="15" type="flex">
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('price'))
                validate-status="error"
                help="{{ $errors->first('price') }}"
            @endif
            label="{{ __('avored::catalog.product.price') }}">
            <a-input
                name="price"
                v-decorator="[
                    'price',
                    {{ ($product->price !== '') ? "{'initialValue': '" . $product->price . "'}," : "" }}
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('avored::validation.required', ['attribute' => 'Price']) }}' 
                            }
                        ]
                    }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>


    <a-col :span="12">
        <a-form-item
            @if ($errors->has('cost_price'))
                validate-status="error"
                help="{{ $errors->first('cost_price') }}"
            @endif
            label="{{ __('avored::catalog.product.cost_price') }}">
            <a-input
                name="cost_price"
                v-decorator="[
                    'cost_price',
                    {{ ($product->cost_price !== '') ? "{'initialValue': '" . $product->cost_price . "'}," : "" }}
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('avored::validation.required', ['attribute' => 'Cost Price']) }}' 
                            }
                        ]
                    }
                ]"
            ></a-input>

        </a-form-item>
    </a-col>

</a-row>


<a-row :gutter="15" type="flex">
    <a-col :span="6">
        <a-form-item
            @if ($errors->has('length'))
                validate-status="error"
                help="{{ $errors->first('length') }}"
            @endif
            label="{{ __('avored::catalog.product.length') }}">
            <a-input
                name="length"
                v-decorator="[
                    'length',
                    {{ ($product->length !== '') ? "{'initialValue': '" . $product->length . "'}," : "" }}
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('avored::validation.required', ['attribute' => 'Length']) }}' 
                            }
                        ]
                    }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>


    <a-col :span="6">
        <a-form-item
            @if ($errors->has('width'))
                validate-status="error"
                help="{{ $errors->first('width') }}"
            @endif
            label="{{ __('avored::catalog.product.width') }}">
            <a-input
                name="width"
                v-decorator="[
                    'width',
                    {{ ($product->width !== '') ? "{'initialValue': '" . $product->width . "'}," : "" }}
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('avored::validation.required', ['attribute' => 'Width']) }}' 
                            }
                        ]
                    }
                ]"
            ></a-input>

        </a-form-item>
    </a-col>
    <a-col :span="6">
        <a-form-item
            @if ($errors->has('height'))
                validate-status="error"
                help="{{ $errors->first('height') }}"
            @endif
            label="{{ __('avored::catalog.product.height') }}">
            <a-input
                name="height"
                v-decorator="[
                    'height',
                    {{ ($product->height !== '') ? "{'initialValue': '" . $product->height . "'}," : "" }}
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('avored::validation.required', ['attribute' => 'Height']) }}' 
                            }
                        ]
                    }
                ]"
            ></a-input>

        </a-form-item>
    </a-col>
    <a-col :span="6">
        <a-form-item
        @if ($errors->has('weight'))
            validate-status="error"
            help="{{ $errors->first('weight') }}"
        @endif
        label="{{ __('avored::catalog.product.weight') }}">
        <a-input
            name="weight"
            v-decorator="[
                'weight',
                {{ ($product->weight !== '') ? "{'initialValue': '" . $product->weight . "'}," : "" }}
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'Weight']) }}' 
                        }
                    ]
                }
            ]"
        ></a-input>
    </a-col>
</a-form-item>

</a-row>


<a-form-item
    @if ($errors->has('meta_title'))
        validate-status="error"
        help="{{ $errors->first('meta_title') }}"
    @endif
    label="{{ __('avored::catalog.product.meta_title') }}">
    <a-input
        name="meta_title"
        v-decorator="[
            'meta_title',
            {'initialValue': '{{ $product->meta_title ?? '' }}'},
            {rules: 
                [
                    {   required: false, 
                        message: '{{ __('avored::validation.required', ['attribute' => 'Meta Title']) }}' 
                    }
                ]
            }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('meta_description'))
        validate-status="error"
        help="{{ $errors->first('meta_description') }}"
    @endif
    label="{{ __('avored::catalog.product.meta_description') }}">
    <a-input
        name="meta_description"
        v-decorator="[
            'meta_description',
            {'initialValue': '{{ $product->meta_description ?? '' }}'},
            {rules: 
                [
                    {   required: false, 
                        message: '{{ __('avored::validation.required', ['attribute' => 'meta_description']) }}' 
                    }
                ]
            }
        ]"
    ></a-input>
</a-form-item>
</a-card>
