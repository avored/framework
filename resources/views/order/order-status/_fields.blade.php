<div class="mt-3">
    <x-avored::form.input
        name="name"
        autofocus
        value="{{ $orderStatus->name ?? '' }}"
        label="{{ __('avored::system.name') }}"
    ></x-avored::form.input>
</div>


<div class="mt-3">
    <x-avored::form.checkbox
        name="is_default"
        value="{{ $orderStatus->is_default ?? '' }}"
        label="{{ __('avored::system.is_default') }}"
    ></x-avored::form.checkbox>
</div>
