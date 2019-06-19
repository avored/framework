<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::system.language.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {initialValue: '{{ ($language->name) ?? '' }}' },
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
    @if ($errors->has('code'))
        validate-status="error"
        help="{{ $errors->first('code') }}"
    @endif
    label="{{ __('avored::system.language.code') }}"
>
    <a-input
        :auto-focus="true"
        name="code"
        v-decorator="[
        'code',
        {initialValue: '{{ ($language->code) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'code']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('is_default'))
        validate-status="error"
        help="{{ $errors->first('is_default') }}"
    @endif
    label="{{ __('avored::system.language.is_default') }}"
>
    <a-switch
        {{ (isset($language) && $language->is_default) ? 'default-checked' : '' }}
        v-on:change="isLanguageDefaultSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" v-model="is_default" name="is_default"  />
