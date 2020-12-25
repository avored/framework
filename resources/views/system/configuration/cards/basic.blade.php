<div class="mt-3">
    <avored-input
        label-text="{{ __('avored::system.configuration.basic.site_name') }}"
        field-name="site_name"
        init-value="{{ ($repository->getValueByCode('site_name')) ?? '' }}" 
        error-text="{{ $errors->first('site_name') }}"
    ></avored-input>
</div>

<div class="mt-3">
    <avored-select
        label-text="{{ __('avored::system.configuration.basic.default_currency') }}"
        field-name="default_currency"
        :options="{{ $currencyOptions }}"
        init-value="{{ ($repository->getValueByCode('default_currency')) ?? '' }}" 
        error-text="{{ $errors->first('default_currency') }}"
    ></avored-select>
</div>

<div class="mt-3">
    <avored-input
        label-text="{{ __('avored::system.order_email_address') }}"
        field-name="order_email_address"
        init-value="{{ ($repository->getValueByCode('order_email_address')) ?? '' }}" 
        error-text="{{ $errors->first('order_email_address') }}"
    ></avored-input>
</div>


@php
    $options = collect();
    $options->put('ENABLED', 'Enabled');
    $options->put('DISABLED', 'Disabled');
@endphp

<div class="mt-3">
    <avored-select
        label-text="{{ __('avored::system.multiple_language') }}"
        field-name="is_app_has_multiple_language"
        :options="{{ $options }}"
        init-value="{{ ($repository->getValueByCode('is_app_has_multiple_language')) ?? 'DISABLED' }}"
        error-text="{{ $errors->first('is_app_has_multiple_language') }}"
    ></avored-select>
</div>
