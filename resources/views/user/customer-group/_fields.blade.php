 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $customerGroup->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.fields.is_default') }}"
        error-text="{{ $errors->first('is_default') }}"
        field-name="is_default"
        init-value="{{ $customerGroup->is_default ?? '' }}"
    >
    </avored-toggle>
</div>
