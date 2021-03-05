<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'name',
        'label' => __('avored::system.name'),
        'value' => $customerGroup->name ?? ''
    ])
</div>


<div class="flex mt-3 w-full">
    @include('avored::system.form.toggle', [
        'name' => 'is_default',
        'label' => __('avored::system.is_default'),
        'value' => $customerGroup->is_default ?? null
    ])
</div>

{{-- 
<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.fields.is_default') }}"
        error-text="{{ $errors->first('is_default') }}"
        field-name="is_default"
        init-value="{{ $customerGroup->is_default ?? '' }}"
    >
    </avored-toggle>
</div> --}}
