<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::catalog.attribute.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $attribute->name ?? '' }}'},
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
    label="{{ __('avored::catalog.attribute.slug') }}"
>
    <a-input
        name="slug"
        v-decorator="[
        'slug',
        {'initialValue': '{{ $attribute->slug ?? '' }}'},
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
    @if ($errors->has('display_as'))
        validate-status="error"
        help="{{ $errors->first('display_as') }}"
    @endif
    label="{{ __('avored::catalog.attribute.display_as') }}"
>
    <a-select
        @change="displayAsChange"
        v-decorator="[
        'display_as',
        {'initialValue': '{{ $attribute->display_as ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => __('avored::catalog.attribute.display_as')]) }}' 
                }
            ]
        }
        ]"
    >   
        @foreach ($displayAsOptions as $val => $label)
            <a-select-option value="{{ $val }}">{{ $label }}</a-select-option>
        @endforeach    
    </a-select>
</a-form-item>
<input type="hidden" name="display_as" v-model="display_as" />
<a-card class="mt-1" v-for="(k, index) in dropdownOptions"
    :key="k"
    >
    <a-row :gutter="20">
        <a-col :span="12">
            <a-form-item label="{{ __('avored::catalog.attribute.image') }}">
             <a-upload
                name="dropdown_options_image"
                :default-file-list="getDefaultFile(index)"
                :multiple="false"
                :headers="headers"
                v-on:change="handleUploadImageChange($event, k)"
                action="{{ route('admin.attribute.upload') }}" 
                >
                <a-button>
                <a-icon type="upload"></a-icon> {{ __('avored::catalog.attribute.upload') }}
                </a-button>
            </a-upload>
            </a-form-item>
        </a-col>
        <a-col :span="12">
            <a-form-item
                @if ($errors->has('dropdown_options'))
                    validate-status="error"
                    help="{{ $errors->first('dropdown_options') }}"
                @endif
                label="{{ __('avored::catalog.attribute.dropdown_options') }}"
            >
                <a-input
                    :name="dropdownOptionDisplayTextName(k)"
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

            <input type="hidden" v-for="path in image_path_lists" :name="imagePathName(path)" :value="imagePathValue(path)" />
        </a-col>
    </a-row>
</a-card>

