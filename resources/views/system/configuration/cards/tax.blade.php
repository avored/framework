<div class="mt-3">
    <avored-input
        label-text="{{ __('avored::system.configuration.tax.tax_percentage') }}"
        field-name="tax_percentage"
        init-value="{{ ($repository->getValueByCode('tax_percentage')) ?? '' }}" 
        error-text="{{ $errors->first('tax_percentage') }}"
    ></avored-input>
</div>
