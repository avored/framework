 <a-form-item
    @if ($errors->has('tax_percentage'))
        validate-status="error"
        help="{{ $errors->first('tax_percentage') }}"
    @endif
    label="{{ __('avored::system.configuration.tax.tax_percentage') }}">
    <a-input
        :auto-focus="true"
        name="tax_percentage"
        v-decorator="[
        'tax_percentage',
        {initialValue: '{{ ($repository->getValueByCode('tax_percentage')) ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => __('avored::system.configuration.basic.tax_percentage')]) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>
