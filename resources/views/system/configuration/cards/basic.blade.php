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

    $multiLanguageSettingValue = $repository->getValueByCode('is_app_has_multiple_language');
@endphp

<div class="mt-3">
    <avored-select
        label-text="{{ __('avored::system.multiple_language') }}"
        field-name="is_app_has_multiple_language"
        :options="{{ $options }}"
        init-value="{{ $multiLanguageSettingValue ?? 'DISABLED' }}"
        error-text="{{ $errors->first('is_app_has_multiple_language') }}"
    ></avored-select>
</div>


@if ($multiLanguageSettingValue === 'ENABLED')
    @php
        $languageRepository = app(\AvoRed\Framework\Database\Contracts\LanguageModelInterface::class);
        $languageOptions = $languageRepository->options('name');

    @endphp
    <div class="mt-3">
        <avored-select
            label-text="{{ __('avored::system.system_default_language_id') }}"
            field-name="system_default_language_id"
            :options="{{ $languageOptions }}"
            init-value="{{ ($repository->getValueByCode('system_default_language_id')) ?? null }}"
            error-text="{{ $errors->first('system_default_language_i    d') }}"
        ></avored-select>
    </div>
@endif
