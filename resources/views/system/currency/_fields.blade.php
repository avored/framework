
 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $currency->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>


<div class="mt-3 w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.code') }}"
        error-text="{{ $errors->first('code') }}"
        field-name="code"
        :options="{{ json_encode($currencyCodeOptions) }}"
        init-value="{{ (isset($currency->code)) ? strtoupper($currency->code) : '' }}"
    >
    </avored-select>
</div>


<div class="mt-3 w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.symbol') }}"
        error-text="{{ $errors->first('symbol') }}"
        field-name="symbol"
        :options="{{ json_encode($currencySymbolOptions) }}"
        init-value="{{ (isset($currency->code)) ? strtoupper($currency->symbol) : '' }}"
    >
    </avored-select>
</div>


 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.conversation_rate') }}"
        field-name="conversation_rate"
        init-value="{{ $currency->conversation_rate ?? '' }}" 
        error-text="{{ $errors->first('conversation_rate') }}"
    >
    </avored-input>
</div>


<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.fields.status') }}"
        error-text="{{ $errors->first('status') }}"
        field-name="status"
        toggle-on-value="ENABLED"
        toggle-off-value="DISABLED"
        init-value="{{ $currency->status ?? '' }}"
    >
    </avored-toggle>
</div>
