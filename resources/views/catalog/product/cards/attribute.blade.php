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

     <a-table :columns="columns" row-key="id" :data-source="productVariations">
        <span slot="name" slot-scope="text, record" href="javascript:;">@{{ record.variation.name }}</span>
        <span slot="price" slot-scope="text, record" href="javascript:;">@{{ record.variation.price }}</span>
        <span slot="qty" slot-scope="text, record" href="javascript:;">@{{ record.variation.qty }}</span>

        <span slot="action" slot-scope="text, record">
            <a href="javascript:;" @click="editVariationModel(record)">Edit</a>
            <a-divider type="vertical" />
            <a href="javascript:;" @click="deleteVariation(record)">Delete</a>
        </span>
    </a-table>

<a-modal title="{{__('avored::catalog.product.variation_model_title') }}"
    v-model="variationModelVisible"
    ok-text="{{__('avored::catalog.product.variation_save_btn') }}"
    @ok="clickVariationSave">

        <a-form  :form="variationForm">
            <a-row type="flex" :gutter="15">
                <a-col :span="12">
                    <a-form-item
                        label="{{ __('avored::catalog.product.name') }}">
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
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
                        label="{{ __('avored::catalog.product.slug') }}">
                        <a-input
                            name="slug"
                            v-decorator="[
                            'slug',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'slug']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row type="flex" :gutter="15">
                <a-col :span="12">
                    <a-form-item
                        label="{{ __('avored::catalog.product.sku') }}">
                        <a-input
                            name="sku"
                            v-decorator="[
                            'sku',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'sku']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item
                        label="{{ __('avored::catalog.product.barcode') }}">
                        <a-input
                            name="barcode"
                            v-decorator="[
                            'barcode',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'barcode']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row type="flex" :gutter="15">
                <a-col :span="12">
                    <a-form-item
                        label="{{ __('avored::catalog.product.qty') }}">
                        <a-input
                            name="qty"
                            v-decorator="[
                            'qty',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'qty']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item
                        label="{{ __('avored::catalog.product.price') }}">
                        <a-input
                            name="price"
                            v-decorator="[
                            'price',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'price']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="15">
                <a-col :span="24">
                    <a-form-item label="{{ __('avored::catalog.product.variation_image') }}">
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
                        </a-form-item>
                </a-col>
            </a-row>
            <a-row type="flex" :gutter="15">
                <a-col :span="6">
                    <a-form-item
                        label="{{ __('avored::catalog.product.weight') }}">
                        <a-input
                            name="weight"
                            v-decorator="[
                            'weight',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'weight']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="6">
                    <a-form-item
                        label="{{ __('avored::catalog.product.height') }}">
                        <a-input
                            name="height"
                            v-decorator="[
                            'height',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'height']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="6">
                    <a-form-item
                        label="{{ __('avored::catalog.product.width') }}">
                        <a-input
                            name="width"
                            v-decorator="[
                            'width',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'width']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="6">
                    <a-form-item
                        label="{{ __('avored::catalog.product.length') }}">
                        <a-input
                            name="length"
                            v-decorator="[
                            'length',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'length']) }}' 
                                    }
                                ]
                            }
                            ]"></a-input>
                    </a-form-item>
                    <a-form-item>
                        <a-input
                            name="id"
                            type="hidden"
                            v-decorator="[
                            'id',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'id']) }}' 
                                    }
                                ]
                            }
                            ]"></a-input>
                    </a-form-item>

                </a-col>
            </a-row>
        </a-form>
</a-modal>

</a-card>
