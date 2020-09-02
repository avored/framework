<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $attribute->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.slug') }}"
        field-name="slug"
        init-value="{{ $attribute->slug ?? '' }}" 
        error-text="{{ $errors->first('slug') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.display_as') }}"
        field-name="display_as"
        error-text="{{ $errors->first('display_as') }}"
        :options="{{ json_encode($displayAsOptions) }}"
        init-value="{{ $attribute->display_as ?? '' }}"
    >
    </avored-select>
</div>

<div class="mt-3 p-5 border rounded" v-for="(k, index) in dropdownOptions"
    :key="index"
    >
<div class="flex items-start">
        <div class="w-1/2">
            <avored-upload
                label-text="{{ __('avored::system.fields.image') }}"
                :field-name="`dropdown_options[${k}][path]`"
                :init-value="getInitDropdownPathValue(index)" 
                error-text="{{ $errors->first('dropdown_options') }}"
                upload-url="{{ route('admin.attribute.upload') }}"
            ></avored-upload>
          
        </div>
        <div class="w-1/2 ml-3">
            <div class="flex w-full">
                <avored-input
                    label-text="{{ __('avored::system.fields.dropdown_options') }}"
                    :field-name="`dropdown_options[${k}][display_text]`"
                    :init-value="getInitDropdownValue(index)" 
                    error-text="{{ $errors->first('dropdown_options') }}"
                >
                    <template slot="addOnAfter">
                        <button type="button" v-on:click="dropdownOptionChange(index)" class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm leading-5 font-medium rounded-r-md text-gray-700 bg-gray-50 hover:text-gray-500 hover:bg-white focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700">
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
        </div>
    </div>
</div>
