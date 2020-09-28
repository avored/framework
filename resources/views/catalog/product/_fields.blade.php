<div class="border rounded">
    <div class="p-5 text-md font-semibold border-b">
        {{ __('avored::system.tab.basic_info') }}
    </div>
    <div class="p-5">
        <div class="flex items-center">
            <div class="w-1/2">
                <div class="mt-3 flex w-full">
                    <avored-input
                        label-text="{{ __('avored::system.fields.name') }}"
                        field-name="name"
                        init-value="{{ $product->name ?? '' }}" 
                        error-text="{{ $errors->first('name') }}"
                    >
                    </avored-input>
                </div>
            </div>
            <div class="w-1/2 ml-3">
                <div class="mt-3 flex w-full">
                    <avored-input
                        label-text="{{ __('avored::system.fields.slug') }}"
                        field-name="slug"
                        init-value="{{ $product->slug ?? '' }}" 
                        error-text="{{ $errors->first('slug') }}"
                    >
                    </avored-input>
                </div>
            </div>
        </div>
    
        <div class="flex mt-3 items-center">
            <div class="w-1/2">
                <div class="">
                    <avored-select
                        label-text="{{ __('avored::system.fields.category') }}"
                        field-name="category[]"
                        :multiple=true
                        error-text="{{ $errors->first('category') }}"
                        :options="{{ json_encode($categoryOptions) }}"
                        :init-value="{{ $product->categories ?  json_encode($product->categories->pluck('id')->toArray()) : '' }}"
                    >
                    </avored-select>
                    
                </div>
            </div>
            <div class="w-1/2 ml-3">
                <div class="mt-3">
                    <avored-select
                        label-text="{{ __('avored::system.fields.type') }}"
                        field-name="type"
                        :disabled="true"
                        error-text="{{ $errors->first('type') }}"
                        :options="{{ json_encode($typeOptions) }}"
                        init-value="{{ $product->type ?? '' }}"
                    >
                    </avored-select>

                    
                    <input name="type" v-model="type" type="hidden" />
                </div>
            </div>
        </div>


        <div class="flex mt-3 w-full">
            <div class="w-1/2">
                <avored-input
                    label-text="{{ __('avored::system.fields.sku') }}"
                    field-name="sku"
                    init-value="{{ $product->sku ?? '' }}" 
                    error-text="{{ $errors->first('sku') }}"
                >
                </avored-input>
            </div>

            <div class="w-1/2 ml-3">
                <avored-input
                        label-text="{{ __('avored::system.fields.barcode') }}"
                        field-name="barcode"
                        init-value="{{ $product->barcode ?? '' }}" 
                        error-text="{{ $errors->first('barcode') }}"
                    >
                    </avored-input>
            </div>
        </div>

        <div class="block mt-3">
            <div class="block w-full">
                <label for="product-description" title="{{ __('avored::cms.product.description') }}">
                    {{ __('avored::system.fields.description') }}
                </label>
            </div>
            
            <div class="mt-3 block w-full">
                <div class="">
                    <vue-simplemde name="description" v-model="description" ref="markdownEditor" />
                </div>
            </div>
        </div>


        <div class="flex items-center mt-3">
            <div class="w-1/2">
                <avored-input
                    label-text="{{ __('avored::system.fields.qty') }}"
                    field-name="qty"
                    input-type="number"
                    number-steps="any"
                    init-value="{{ $product->qty ?? '' }}" 
                    error-text="{{ $errors->first('qty') }}"
                >
                </avored-input>
            </div>

            <div class="ml-3 w-1/2">
                <div class="mt-3 flex w-full">
                    <avored-toggle
                        label-text="{{ __('avored::system.fields.status') }}"
                        error-text="{{ $errors->first('status') }}"
                        field-name="status"
                        init-value="{{ $product->status ?? '' }}"
                    >
                    </avored-toggle>
                </div>
                
            </div>
        </div>

        <div class="flex items-center mt-3">
            <div class="w-1/2">

                <avored-toggle
                    label-text="{{ __('avored::system.fields.track_stock') }}"
                    error-text="{{ $errors->first('track_stock') }}"
                    field-name="track_stock"
                    init-value="{{ $product->track_stock ?? '' }}"
                >
                </avored-toggle>

            </div>

            <div class="w-1/2 ml-3">

                <avored-toggle
                    label-text="{{ __('avored::system.fields.is_taxable') }}"
                    error-text="{{ $errors->first('is_taxable') }}"
                    field-name="is_taxable"
                    init-value="{{ $product->is_taxable ?? '' }}"
                >
                </avored-toggle>

            </div>
        </div>

        <div class="flex items-center mt-3">
            <div class="w-1/2">
                <avored-input
                    label-text="{{ __('avored::system.fields.price') }}"
                    field-name="price"
                    input-type="number"
                    number-steps="any"
                    init-value="{{ $product->price ?? '' }}" 
                    error-text="{{ $errors->first('price') }}"
                >
                </avored-input>
            </div>


            <div class="w-1/2 ml-3">
                <avored-input
                    label-text="{{ __('avored::system.fields.cost_price') }}"
                    field-name="cost_price"
                    input-type="number"
                    number-steps="any"
                    init-value="{{ $product->cost_price ?? '' }}" 
                    error-text="{{ $errors->first('cost_price') }}"
                >
                </avored-input>
            </div>

        </div>


        <div class="flex items-center mt-3">
            <div class="w-1/4">
                <avored-input
                    label-text="{{ __('avored::system.fields.length') }}"
                    field-name="length"
                    input-type="number"
                    number-steps="any"
                    init-value="{{ $product->length ?? '' }}" 
                    error-text="{{ $errors->first('length') }}"
                >
                </avored-input>
            </div>


            <div class="w-1/4 ml-3">
                <avored-input
                    label-text="{{ __('avored::system.fields.width') }}"
                    field-name="width"
                    input-type="number"
                    number-steps="any"
                    init-value="{{ $product->width ?? '' }}" 
                    error-text="{{ $errors->first('width') }}"
                >
                </avored-input>
            </div>
            <div class="w-1/4 ml-3">
                <avored-input
                    label-text="{{ __('avored::system.fields.height') }}"
                    field-name="height"
                    input-type="number"
                    number-steps="any"
                    init-value="{{ $product->height ?? '' }}" 
                    error-text="{{ $errors->first('height') }}"
                >
                </avored-input>
            </div>
            <div class="w-1/4 ml-3">
                <avored-input
                    label-text="{{ __('avored::system.fields.weight') }}"
                    field-name="weight"
                    input-type="number"
                    number-steps="any"
                    init-value="{{ $product->weight ?? '' }}" 
                    error-text="{{ $errors->first('weight') }}"
                >
                </avored-input>
            </div>
        

        </div>

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
    </div>
</div>
