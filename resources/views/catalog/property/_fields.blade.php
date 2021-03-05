<div x-data="avoredPropertySave()" x-on:change="changeFieldType">
    <div class="flex mt-3 w-full">
        @include('avored::system.form.input', [
            'name' => 'name',
            'label' => __('avored::system.name'),
            'value' => $property->name ?? ''
        ])
    </div>

    <div class="flex mt-3 w-full">
        @include('avored::system.form.input', [
            'name' => 'slug',
            'label' => __('avored::system.slug'),
            'value' => $property->slug ?? ''
        ])
    </div>

    <div class="flex mt-3 w-full">
        @include('avored::system.form.select', [
            'name' => 'data_type',
            'label' => __('avored::system.data-type'),
            'value' => $property->data_type ?? '',
            'options' => $dataTypeOptions
        ])
    </div>

    <div class="flex mt-3 w-full">
        @include('avored::system.form.select', [
            'name' => 'field_type',
            'label' => __('avored::system.field-type'),
            'value' => $property->field_type ?? '',
            'options' => $fieldTypeOptions,
            'attrs' => [
                'x-model' => 'fieldType'
            ]
        ])
    </div>

    <div class="mt-1 flex w-full">
        @include('avored::system.form.toggle', [
            'name' => 'use_for_all_products',
            'label' => __('avored::system.use-for-all-products'),
            'value' => $property->use_for_all_products ?? 0,
            'checkedValue' => 1,
            'unCheckedValue' => 0,
        ])
    </div>

    <div class="mt-1 flex w-full">
        @include('avored::system.form.toggle', [
            'name' => 'is_visible_frontend',
            'label' => __('avored::system.is-visible-frontend'),
            'value' => $property->is_visible_frontend ?? 0,
            'checkedValue' => 1,
            'unCheckedValue' => 0,
        ])
    </div>

    <div class="flex mt-3 w-full">
        @include('avored::system.form.input', [
            'name' => 'sort_order',
            'label' => __('avored::system.sort_order'),
            'value' => $property->sort_order ?? ''
        ])
    </div>

    <template x-if="fieldType === 'SELECT'">
        <template x-for="(dropdownOption, index) in dropdownOptions" x-bind:key="index">
            <div class="flex mt-3 w-full">
                <div class="w-full">
                    <label x-bind:id="dropdownOptionFieldIdentifier('test')"
                        x-bind:data="index"
                        class="block text-sm leading-5 text-gray-500">
                        {{ __('avored::system.option-label') }}
                    </label>
                    <div class="mt-1">
                        <div class="relative flex items-center">
                            <input
                                x-bind:id="dropdownOptionFieldIdentifier('test')"
                                type="{{ $type ?? 'text' }}"
                                x-bind:name="dropdownOptionFieldName('test')"
                                value=""
                                placeholder=""
                                class="px-3 flex-1 w-full py-2 outline-none shadow-sm focus:shadow focus:border rounded border block border-gray-400"
                                />
                        </div>

                       
                    </div>
                </div>
            </div>
        </template>
    </template>
</div>
@push('bottom-scripts')
<script>
    function avoredPropertySave() {
        return {
            fieldType: null,
            dropdownOptions : [{id: 1 , value : null}],
            changeFieldType(e) {
                this.fieldType = e.detail.val
            },
            dropdownOptionFieldIdentifier (option) {
                console.log('test')
            },
            dropdownOptionFieldName(option) {
                console.log(option)
            }
        }
    }
</script>
@endpush
{{-- <template v-if="processDropdownOptionStatus">
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
</template> --}}
