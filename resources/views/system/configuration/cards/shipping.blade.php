
<avored-input
    label-text="{{ __('avored::system.configuration.shipping.shipping_name') }}"
    field-name="site_name"
    init-value="{{ ($repository->getValueByCode('site_name')) ?? '' }}" 
    error-text="{{ $errors->first('site_name') }}"
></avored-input>
