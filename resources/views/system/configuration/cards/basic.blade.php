<div class="mt-3">
    <avored-input
        label-text="{{ __('avored::system.configuration.basic.site_name') }}"
        field-name="site_name"
        init-value="{{ ($repository->getValueByCode('site_name')) ?? '' }}" 
        error-text="{{ $errors->first('site_name') }}"
    >
    </avored-input>
</div>

<div class="mt-3">
    <avored-select
        label-text="{{ __('avored::system.configuration.basic.default_currency') }}"
        field-name="default_currency"
        :options="{{ $currencyOptions }}"
        init-value="{{ ($repository->getValueByCode('default_currency')) ?? '' }}" 
        error-text="{{ $errors->first('default_currency') }}"
    >
    </avored-select>
</div>
