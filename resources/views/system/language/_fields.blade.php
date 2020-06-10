
 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.language.name') }}"
        field-name="name"
        init-value="{{ $language->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>

 <div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.language.code') }}"
        field-name="code"
        init-value="{{ $language->code ?? '' }}" 
        error-text="{{ $errors->first('code') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.language.is_default') }}"
        error-text="{{ $errors->first('is_default') }}"
        field-name="is_default"
        init-value="{{ $language->is_default ?? '' }}"
    >
    </avored-toggle>
</div>
