<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::system.tax-group.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $taxGroup->name ?? '' }}'},
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
    @if ($errors->has('description'))
        validate-status="error"
        help="{{ $errors->first('description') }}"
    @endif
    label="{{ __('avored::system.tax-group.description') }}"
>
    <a-input
        name="description"
        v-decorator="[
        'description',
        {'initialValue': '{{ $taxGroup->description ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'description']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>
