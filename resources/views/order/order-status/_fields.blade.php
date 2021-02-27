<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'name',
        'label' => __('avored::system.name'),
        'value' => $orderStatus->name ?? ''
    ])
</div>


<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::order.order-status.is_default') }}"
        error-text="{{ $errors->first('is_default') }}"
        field-name="is_default"
        init-value="{{ $orderStatus->is_default ?? '' }}">
    </avored-toggle>
</div>
