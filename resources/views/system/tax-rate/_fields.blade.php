<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::system.tax-rate.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $taxRate->name ?? '' }}'},
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
    @if ($errors->has('description'))
        validate-status="error"
        help="{{ $errors->first('description') }}"
    @endif
    label="{{ __('avored::system.tax-rate.description') }}"
>
    <a-input
        name="description"
        v-decorator="[
        'description',
        {'initialValue': '{{ $taxRate->description ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'description']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('rate'))
        validate-status="error"
        help="{{ $errors->first('rate') }}"
    @endif
    label="{{ __('avored::system.tax-rate.rate') }}"
>
    <a-input
        name="rate"
        v-decorator="[
        'rate',
        {'initialValue': '{{ $taxRate->rate ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'rate']) }}' 
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
    label="{{ __('avored::system.tax-rate.country_id') }}"
>
     <a-select default-value="{{ ($taxRate->country_id) ?? '' }}"   @change="handleCountrySelectChange">
        @foreach($countryOptions as $countryId => $countryName)
            <a-select-option value="{{ $countryId }}">{{ $countryName }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" name="country_id" v-model="country_id" />

<a-form-item
    @if ($errors->has('postcode'))
        validate-status="error"
        help="{{ $errors->first('postcode') }}"
    @endif
    label="{{ __('avored::system.tax-rate.postcode') }}"
>
    <a-input
        name="postcode"
        v-decorator="[
        'postcode',
        {'initialValue': '{{ $taxRate->postcode ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'postcode']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('rate_type'))
        validate-status="error"
        help="{{ $errors->first('rate_type') }}"
    @endif
    label="{{ __('avored::system.tax-rate.rate_type') }}"
>
     <a-select default-value="{{ ($taxRate->rate_type) ?? '' }}"   @change="handleRateTypeChange">
        @foreach($typeOptions as $typeVal => $typeLabel)
            <a-select-option value="{{ $typeVal }}">{{ $typeLabel }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" name="rate_type" v-model="rate_type" />
