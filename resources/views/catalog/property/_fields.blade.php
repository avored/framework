<div x-data="avoredPropertySave()" 
    x-init="init('{{ $property ?? json_encode (json_decode ("{}")) }}')" 
    x-on:change-dropdown.window="fieldType =  ($event.detail.name === 'field_type') ?  $event.detail.value: fieldType"">
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
        <div class="border mt-5">
            <div class="text-md p-3 border-b">
                {{ __('avored::system.dropdown-options') }}
            </div>
            <div class="p-3">
                <template x-for="(dropdownOption, index) in dropdownOptions" x-bind:key="index">
                    <div class="flex mt-3 w-full">
                        <div class="w-full">
                            <label x-bind:id="`dropdown-option-${dropdownOption.id}`"
                                x-bind:data="index"
                                class="block text-sm leading-5 text-gray-500">
                                {{ __('avored::system.option-label') }}
                            </label>
                            <div class="mt-1">
                                <div class="relative flex items-center">
                                    <input
                                        x-bind:id="`dropdown-option-${dropdownOption.id}`"
                                        type="{{ $type ?? 'text' }}"
                                        x-bind:name="`dropdown_option[${dropdownOption.id}]`"
                                        x-model="dropdownOption.display_text"
                                        placeholder=""
                                        class="px-3 flex-1 w-full py-2 outline-none shadow-sm focus:shadow focus:border rounded border block border-r-0 border-gray-300"
                                        />
                                    <button type="button" x-on:click="dropdownOptionChange(index)" 
                                        class="-ml-px relative inline-flex items-center px-4 py-3 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
                                        <svg x-show="(index == dropdownOptions.length - 1)" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                                        </svg>
                                        <svg x-show="!(index == dropdownOptions.length - 1)" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path class="heroicon-ui" d="M17 11a1 1 0 010 2H7a1 1 0 010-2h10z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
@push('bottom-scripts')
<script>
    function avoredPropertySave() {
        return {
            fieldType: null,
            property: null,
            dropdownOptions: [],
            init(property) {
                this.property = JSON.parse(property)
                this.fieldType = this.property.field_type
                if (_.size(_.get(this.property, 'dropdown_options')).length > 0) {
                    this.dropdownOptions = this.property.dropdown_options

                } else {
                    this.dropdownOptions = []
                    this.dropdownOptions.push({
                        id: this.randomString(),
                        display_text: ''
                    })
                }
            },
            randomString() {
                let random_string = "";
                let random_ascii;
                for (let i = 0; i < 6; i++) {
                    random_ascii = Math.floor(Math.random() * 25 + 97);
                    random_string += String.fromCharCode(random_ascii);
                }
                return random_string;
            },
            changeFieldType(e) {
                this.fieldType = e.detail.val
            },
           
            dropdownOptionChange(index) {
                if (index + 1  === _.size(this.dropdownOptions)) {
                    this.dropdownOptions.push({
                        id: this.randomString(),
                        display_text: ''
                    })
                } else {
                    this.dropdownOptions.splice(index, 1)
                }
            },
           
        }
    }
</script>
@endpush
