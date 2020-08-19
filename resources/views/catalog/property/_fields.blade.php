<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $property->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.slug') }}"
        field-name="slug"
        init-value="{{ $property->slug ?? '' }}" 
        error-text="{{ $errors->first('slug') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.data_type') }}"
        field-name="data_type"
        error-text="{{ $errors->first('data_type') }}"
        :options="{{ json_encode($dataTypeOptions) }}"
        init-value="{{ $property->data_type ?? '' }}"
    >
    </avored-select>
</div>

<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.field_type') }}"
        error-text="{{ $errors->first('field_type') }}"
        field-name="field_type"
        :options="{{ json_encode($fieldTypeOptions) }}"
        init-value="{{ $property->field_type ?? '' }}"
    >
    </avored-select>
</div>

<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.fields.use_for_all_products') }}"
        error-text="{{ $errors->first('use_for_all_products') }}"
        field-name="use_for_all_products"
        init-value="{{ $property->use_for_all_products ?? '' }}"
    >
    </avored-toggle>
</div>

<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.fields.is_visible_frontend') }}"
        error-text="{{ $errors->first('is_visible_frontend') }}"
        field-name="is_visible_frontend"
        init-value="{{ $property->is_visible_frontend ?? '' }}"
    >
    </avored-toggle>
</div>



<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.sort_order') }}"
        field-name="sort_order"
        init-value="{{ $property->sort_order ?? '' }}" 
        error-text="{{ $errors->first('sort_order') }}"
    >
    </avored-input>
</div>

<template v-if="processDropdownOptionStatus">
    <div class="mt-3 flex w-full"

        v-for="(k, index) in dropdownOptions"
        :key="k">
        <avored-input
            label-text="{{ __('avored::system.fields.dropdown_option') }}"
            :field-name="dropdown_options(k)"
            :init-value="getInitDropdownValue(index)"
            error-text="{{ $errors->first('dropdown_options') }}"
        >
            <template slot="addOnAfter">
                <button type="button" v-on:click="dropdownOptionChange(index)" 
                    class="-ml-px relative inline-flex items-center px-4 py-3 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                    <svg v-if="(index == dropdownOptions.length - 1)" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                    </svg>
                    <svg v-if="!(index == dropdownOptions.length - 1)" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/>
                    </svg>
                </button>
            </template>
        </avored-input>
    </div>
</template>
