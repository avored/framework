<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::catalog.property.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $property->name ?? '' }}'},
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

<a-form-item
    @if ($errors->has('slug'))
        validate-status="error"
        help="{{ $errors->first('slug') }}"
    @endif
    label="{{ __('avored::catalog.property.slug') }}"
>
    <a-input
        name="slug"
        v-decorator="[
        'slug',
        {'initialValue': '{{ $property->slug ?? '' }}'},
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

<a-form-item
    @if ($errors->has('data_type'))
        validate-status="error"
        help="{{ $errors->first('data_type') }}"
    @endif
    label="{{ __('avored::catalog.property.data_type') }}"
>
    <a-select default-value="{{ $property->data_type ?? '' }}" v-on:change="dataTypeChange">
        @foreach ($dataTypeOptions as $dataType => $label)
            <a-select-option value="{{ $dataType }}">{{ $label }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" name="data_type" v-model="data_type" />

<a-form-item
    @if ($errors->has('field_type'))
        validate-status="error"
        help="{{ $errors->first('field_type') }}"
    @endif
    label="{{ __('avored::catalog.property.field_type') }}"
>
    <a-select default-value="{{ $property->field_type ?? '' }}" v-on:change="fieldTypeChange">
        @foreach ($fieldTypeOptions as $fieldType => $label)
            <a-select-option value="{{ $fieldType }}">{{ $label }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" name="field_type" v-model="field_type" />

<a-form-item
    @if ($errors->has('use_for_all_products'))
        validate-status="error"
        help="{{ $errors->first('use_for_all_products') }}"
    @endif
    label="{{ __('avored::catalog.property.use_for_all_products') }}">
    <a-switch
        {{ (isset($property) && $property->use_for_all_products) ? 'default-checked' : '' }}
        v-on:change="useForAllProductSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" name="use_for_all_products" v-model="use_for_all_products" />

<a-form-item
    @if ($errors->has('use_for_category_filter'))
        validate-status="error"
        help="{{ $errors->first('use_for_category_filter') }}"
    @endif
    label="{{ __('avored::catalog.property.use_for_category_filter') }}">
    <a-switch
        {{ (isset($property) && $property->use_for_category_filter) ? 'default-checked' : '' }}
        v-on:change="useForCategoryFilterSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" name="use_for_category_filter" v-model="use_for_category_filter" />

<a-form-item
    @if ($errors->has('is_visible_frontend'))
        validate-status="error"
        help="{{ $errors->first('is_visible_frontend') }}"
    @endif
    label="{{ __('avored::catalog.property.is_visible_frontend') }}"
>
    <a-switch
        {{ (isset($property) && $property->is_visible_frontend) ? 'default-checked' : '' }}
        v-on:change="isVisibleInFrontendSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" name="is_visible_frontend" v-model="is_visible_frontend" />

<a-form-item
    @if ($errors->has('sort_order'))
        validate-status="error"
        help="{{ $errors->first('sort_order') }}"
    @endif
    label="{{ __('avored::catalog.property.sort_order') }}"
>
    <a-input
        name="sort_order"
        v-decorator="[
        'sort_order',
        {'initialValue': '{{ $property->sort_order ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'SortOrder']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>



<a-form-item
    v-for="(k, index) in dropdownOptions"
    :key="k"
    @if ($errors->has('dropdown_options'))
        validate-status="error"
        help="{{ $errors->first('dropdown_options') }}"
    @endif
    label="{{ __('avored::catalog.property.dropdown_options') }}"
>
    <a-input
        :name="dropdown_options(k)"
        v-decorator="[
        `dropdown_options[${k}]`,
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Dropdown Options']) }}' 
                }
            ]
        }
        ]"
    >
    <a-icon slot="addonAfter"
        v-on:click="dropdownOptionChange(index)"
        :type="(index == dropdownOptions.length - 1) ? 'plus' : 'minus'"
    ></a-icon>
    </a-input>
</a-form-item>

