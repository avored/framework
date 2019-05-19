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
    v-for="(k, index) in dropdownOptions"
    :key="k"
    @if ($errors->has('dropdown_options'))
        validate-status="error"
        help="{{ $errors->first('dropdown_options') }}"
    @endif
    label="{{ __('avored::catalog.attribute.dropdown_options') }}"
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

