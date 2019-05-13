<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::order.order-status.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $orderStatus->name ?? '' }}'},
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
    @if ($errors->has('is_default'))
        validate-status="error"
        help="{{ $errors->first('is_default') }}"
    @endif
    label="{{ __('avored::order.order-status.is_default') }}"
>
    <a-switch
        {{ (isset($orderStatus) && $orderStatus->is_default) ? 'default-checked' : '' }}
        v-on:change="isOrderStatusDefaultSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" v-model="is_default" name="is_default"  />
