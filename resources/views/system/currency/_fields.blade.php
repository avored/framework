<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::system.currency.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {initialValue: '{{ ($currency->name) ?? '' }}' },
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
    label="{{ __('avored::system.currency.code') }}"
>
    <a-select default-value="{{ ($currency->code) ?? '' }}"   @change="handleCodeSelectChange" >
        @foreach($currencyCodeOptions as $code)
            <a-select-option value="{{ $code }}">Currency Code- {{ $code }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" name="code" v-model="code" />

<a-form-item
    @if ($errors->has('symbol'))
        validate-status="error"
        help="{{ $errors->first('symbol') }}"
    @endif
    label="{{ __('avored::system.currency.symbol') }}"
>
    <a-select default-value="{{ ($currency->symbol) ?? '' }}"   @change="handleSymbolSelectChange">
        @foreach($currencySymbolOptions as $symbol)
            <a-select-option value="{{ $symbol }}">Currency Symbol- {{ $symbol }}</a-select-option>
        @endforeach
    </a-select>
</a-form-item>
<input type="hidden" name="symbol" v-model="symbol" />


<a-form-item
    @if ($errors->has('conversation_rate'))
        validate-status="error"
        help="{{ $errors->first('conversation_rate') }}"
    @endif
    label="{{ __('avored::system.currency.conversation_rate') }}"
>
    <a-input
        :auto-focus="true"
        name="conversation_rate"
        v-decorator="[
        'conversation_rate',
        {initialValue: '{{ ($currency->conversation_rate) ?? '' }}' },
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'conversation_rate']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>

<a-form-item
    @if ($errors->has('status'))
        validate-status="error"
        help="{{ $errors->first('status') }}"
    @endif
    label="{{ __('avored::system.currency.status') }}"
>
    <a-switch
        {{ (isset($currency) && $currency->status) ? 'default-checked' : '' }}
        v-on:change="isStatusSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" v-model="status" name="status"  />
