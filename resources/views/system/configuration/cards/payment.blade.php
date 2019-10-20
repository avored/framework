 <a-form-item
    @if ($errors->has('site_name'))
        validate-status="error"
        help="{{ $errors->first('site_name') }}"
    @endif
    label="{{ __('avored::system.configuration.payment.payment_name') }}">
    <a-input
        :auto-focus="true"
        name="site_name"
        v-decorator="[
        'site_name',
        {initialValue: '{{ ($repository->getValueByCode('site_name')) ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => __('avored::system.configuration.basic.site_name')]) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>
