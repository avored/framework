<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::user.user-group.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $userGroup->name ?? '' }}'},
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
    label="{{ __('avored::user.user-group.is_default') }}"
>
    <a-switch
        {{ (isset($userGroup) && $userGroup->is_default) ? 'default-checked' : '' }}
        v-on:change="isDefaultSwitchChange"
    ></a-switch>
</a-form-item>
<input type="hidden" v-model="is_default" name="is_default"  />
