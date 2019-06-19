<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::system.state.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {initialValue: '{{ ($state->name) ?? '' }}' },
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
    label="{{ __('avored::system.state.code') }}"
>
    <a-input
        :auto-focus="true"
        name="code"
        v-decorator="[
        'code',
        {initialValue: '{{ ($state->code) ?? '' }}' },
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
    @if ($errors->has('country_id'))
        validate-status="error"
        help="{{ $errors->first('country_id') }}"
    @endif
    label="{{ __('avored::system.state.country_id') }}"
>
    <a-select default-value="{{ ($state->country_id) ?? '' }}"   @change="handleCountrySelectChange">
        @foreach($countryOptions as $countryId => $countryName)
            <a-select-option value="{{ $countryId }}">{{ $countryName }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" name="country_id" v-model="country_id" />
