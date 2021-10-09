<div x-data="avoredPropertySave()"
    x-init="init({{ $property ?? null }})"
    x-on:change-dropdown.window="fieldType =  ($event.detail.name === 'field_type') ?  $event.detail.value: fieldType">
    <div class="flex w-full">
        <div class="w-1/2">
            <div class="mt-3">
                <x-avored::form.input
                    name="name"
                    autofocus
                    value="{{ $property->name ?? '' }}"
                    label="{{ __('avored::system.name') }}"
                ></x-avored::form.input>
            </div>
        </div>
        <div class="w-1/2 ml-3">
            <div class="mt-3">
                <x-avored::form.input
                    name="slug"
                    value="{{ $property->slug ?? '' }}"
                    label="{{ __('avored::system.slug') }}"
                ></x-avored::form.input>
            </div>
        </div>
    </div>


    <div class="flex w-full">
        <div class="w-1/2">
            <div class="mt-3">
                <x-avored::form.select
                    name="field_type"
                    x-model='fieldType'
                    label="{{ __('avored::system.field_type') }}"
                >
                    <option value="">{{ __('avored::system.please_select') }}</option>
                    @foreach ($fieldTypeOptions as $fieldTypeValue => $fieldTypeLabel)
                        <option {{ (isset($property) && $property->field_type === $fieldTypeValue)  ? 'selected' : ''}} value="{{ $fieldTypeValue }}">
                            {{ $fieldTypeLabel }}
                        </option>
                    @endforeach

                </x-avored::form.select>
            </div>

        </div>
        <div class="w-1/2 ml-3">
            <div class="mt-3">
                <x-avored::form.select
                    name="data_type"
                    label="{{ __('avored::system.data_type') }}"
                >

                    <option value="">{{ __('avored::system.please_select') }}</option>
                    @foreach ($dataTypeOptions as $dataTypeValue => $dataTypeLabel)
                        <option {{ (isset($property) && $property->data_type === $dataTypeValue)  ? 'selected' : ''}} value="{{ $dataTypeValue }}">
                            {{ $dataTypeLabel }}
                        </option>
                    @endforeach

                </x-avored::form.select>
            </div>
        </div>

    </div>

    <div class="mt-3">
        <x-avored::form.checkbox
            name="use_for_all_products"
            value="{{ $property->use_for_all_products ?? '' }}"
            label="{{ __('avored::system.use_for_all_products') }}"
        ></x-avored::form.checkbox>
    </div>
    <div class="mt-3">
        <x-avored::form.checkbox
            name="use_for_category_filter"
            value="{{ $property->use_for_category_filter ?? '' }}"
            label="{{ __('avored::system.use_for_category_filter') }}"
        ></x-avored::form.checkbox>
    </div>
    <div class="mt-3">
        <x-avored::form.input
            name="sort_order"
            type="number"
            value="{{ $property->sort_order ?? '' }}"
            label="{{ __('avored::system.sort_order') }}"
        ></x-avored::form.input>
    </div>



    <template x-if="fieldType === 'SELECT'">
        <div class="border mt-5">
            <div class="text-md p-3 border-b">
                {{ __('avored::system.dropdown_options') }}
            </div>
            <div class="p-3">
                <template x-for="(dropdownOption, index) in dropdownOptions" x-bind:key="index">
                    <div class="flex mt-3 w-full">
                        <div class="w-full">
                            <label x-bind:id="`dropdown-option-${dropdownOption.id}`"
                                x-bind:data="index"
                                class="block text-sm leading-5 text-gray-500">
                                {{ __('avored::system.option_label') }}
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

@push('scripts')
<script>
    function avoredPropertySave() {
        return {
            fieldType: null,
            property: null,
            dropdownOptions: [],
            init(property) {
                if (typeof property == 'undefined') {
                    this.property = {}
                } else {
                    this.property = property
                }
                this.fieldType = this.property.field_type
                if (_.size(_.get(this.property, 'dropdown_options')) > 0) {
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
