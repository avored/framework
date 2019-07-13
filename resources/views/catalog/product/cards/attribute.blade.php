<a-card class="mt-1 mb-1" title="{{ __('avored::catalog.product.attribute_card_title') }}">

    <div slot="extra">
        <a-button type="primary">Add Variation</a-button>
    </div>
    <p>Attribute Content</p>
    <p>
        <a-select @change="changeVariation" mode="multiple"  placeholder="Please select">
            @foreach ($attributes as $attribute)
                <a-select-option value="{{ $attribute->id }}" key="{{ $attribute->id }}">
                    {{ $attribute->name }}
                </a-select-option>
            @endforeach
        </a-select>
        <div class="add-on-button">
            <a-button @click="handleVariationBtnClick" type="primary">
                {{ __('avored::catalog.product.variation_btn') }}
            </a-button>
        </div>
    </p>

    <h4>{{ __('avored::catalog.product.variation_title') }}</h4>

     <a-table :columns="columns" :data-source="variationData">
        <a slot="name" slot-scope="text" href="javascript:;">@{{text}}</a>
        <span slot="customTitle"><a-icon type="smile-o"></a-icon> Name</span>
        <span slot="attributes" slot-scope="attributes">
            <a-tag v-for="attribute in attributes" color="blue" :key="attribute">@{{attribute}}</a-tag>
        </span>
        <span slot="action" slot-scope="text, record">
        <a href="javascript:;">Edit</a>
        <a-divider type="vertical" />
        <a href="javascript:;">Delete</a>
        
        </span>
    </a-table>

    
</a-card>
