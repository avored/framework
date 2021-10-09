
<div class="mt-3">
    <x-avored::form.input
        name="site_name"
        autofocus
        value="{{ ($repository->getValueByCode('site_name')) ?? '' }}"
        label="{{ __('avored::system.site_name') }}"
    ></x-avored::form.input>
</div>
<div class="mt-3">
    <x-avored::form.input
        name="order_email_address"
        value="{{ ($repository->getValueByCode('order_email_address')) ?? '' }}"
        label="{{ __('avored::system.order_email_address') }}"
    ></x-avored::form.input>
</div>
