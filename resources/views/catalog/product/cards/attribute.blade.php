<a-card class="mt-1 mb-1" title="{{ __('avored::catalog.product.attribute_card_title') }}">
    <p>
        <a-form-item label="{{ __('avored::catalog.product.attribute_card_title') }}">
        <a-select @change="changeVariation" :default-value="attributeIds" mode="multiple"  placeholder="Please select">
            @foreach ($attributes as $attribute)
                <a-select-option :value="{{ $attribute->id }}" key="{{ $attribute->id }}">
                    {{ $attribute->name }}
                </a-select-option>
            @endforeach
        </a-select>
        </a-form-item>
        <div class="add-on-button">
            <a-button @click="handleVariationBtnClick" type="primary">
                {{ __('avored::catalog.product.variation_btn') }}
            </a-button>
        </div>
    </p>

    <h4>{{ __('avored::catalog.product.variation_title') }}</h4>

     <avored-table :columns="columns" row-key="id" :items="productVariations">
        <template slot="variableProductName" slot-scope="{item}">
            @{{ item.variation.name }}
        </template>
        <template slot="variableProductPrice" slot-scope="{item}">
            @{{ item.variation.price }}
        </template>
        <template slot="variableProductQty" slot-scope="{item}">
            @{{ item.variation.qty }}
        </template>
        <template slot="variableProductAction" slot-scope="{item}">
            <a href="javascript:;" @click="editVariationModel(item)">Edit</a>
            <a-divider type="vertical" />
            <a href="javascript:;" @click="deleteVariation(item)">Delete</a>
        </template>
      
    </avored-table>

<a-modal title="{{__('avored::catalog.product.variation_model_title') }}"
    v-model="variationModelVisible"
    ok-text="{{__('avored::catalog.product.variation_save_btn') }}"
    @ok="clickVariationSave">
        
            <div class="flex items-center">
                <div class="w-1/2">
                    <avored-input
                    label-text="{{ __('avored::system.fields.name') }}"
                    field-name="name"
                    :init-value="variationModel.name"
                    v-model="variationModel.name"
                    ></avored-input>
                </div>
                <div class="ml-3 w-1/2">
                    <avored-input
                    label-text="{{ __('avored::system.fields.slug') }}"
                    field-name="slug"
                    :init-value="variationModel.slug"
                    v-model="variationModel.slug"
                    ></avored-input>
                </div>
            </div>
            <div class="flex items-center mt-3">
                <div class="w-1/2">
                    <avored-input
                    label-text="{{ __('avored::system.fields.sku') }}"
                    field-name="sku"
                    :init-value="variationModel.sku"
                    v-model="variationModel.sku"
                    ></avored-input>
                </div>
                <div class="ml-3 w-1/2">
                    <avored-input
                    label-text="{{ __('avored::system.fields.barcode') }}"
                    field-name="barcode"
                    :init-value="variationModel.barcode"
                    v-model="variationModel.barcode"
                    ></avored-input>
                </div>
            </div>
           
            <div class="flex items-center mt-3">
                <div class="w-1/2">
                    <avored-input
                    label-text="{{ __('avored::system.fields.qty') }}"
                    field-name="qty"
                    :init-value="variationModel.qty"
                    v-model="variationModel.qty"
                    ></avored-input>
                </div>
                <div class="ml-3 w-1/2">
                    <avored-input
                    label-text="{{ __('avored::system.fields.price') }}"
                    field-name="price"
                    :init-value="variationModel.price"
                    v-model="variationModel.price"
                    ></avored-input>
                </div>
            </div>
        
            
            <div class="flex mt-3 mb-5">
                <div class="w-full">
                    <div class="block">
                        <label>{{ __('avored::catalog.product.variation_image') }}</label>
                        <a-upload
                            name="file"
                            :multiple="false"
                            :default-file-list="variationImageList"
                            :headers="headers"
                            :action="variationUploadImagePath" 
                            >
                            <a-button>
                                <a-icon type="upload"></a-icon> {{ __('avored::catalog.product.variation_image_upload') }}
                            </a-button>
                        </a-upload>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-3">
                <div class="w-1/4">
                    <avored-input
                    label-text="{{ __('avored::system.fields.weight') }}"
                    field-name="weight"
                    :init-value="variationModel.weight"
                    v-model="variationModel.weight"
                    ></avored-input>
                </div>
                <div class="ml-3 w-1/4">
                    <avored-input
                    label-text="{{ __('avored::system.fields.height') }}"
                    field-name="height"
                    :init-value="variationModel.height"
                    v-model="variationModel.height"
                    ></avored-input>
                </div>
                <div class="ml-3 w-1/4">
                    <avored-input
                    label-text="{{ __('avored::system.fields.width') }}"
                    field-name="width"
                    :init-value="variationModel.width"
                    v-model="variationModel.width"
                    ></avored-input>
                </div>
                <div class="ml-3 w-1/4">
                    <avored-input
                    label-text="{{ __('avored::system.fields.length') }}"
                    field-name="length"
                    :init-value="variationModel.length"
                    v-model="variationModel.length"
                    ></avored-input>
                </div>
        </div>
</a-modal>

</a-card>
