
<div class="mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'name',
        'label' => __('avored::system.name'),
        'value' => $currency->name ?? ''
    ])
</div>

<div class="mt-3 w-full">
    @include('avored::system.form.select', [
        'name' => 'code',
        'label' => __('avored::system.code'),
        'value' => $currency->code ?? '',
        'options' => $currencyCodeOptions
    ])
</div>

<div class="mt-3 w-full">
    @include('avored::system.form.select', [
        'name' => 'symbol',
        'label' => __('avored::system.symbol'),
        'value' => $currency->symbol ?? '',
        'options' => $currencySymbolOptions
    ])
</div>


<div class="mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'conversation_rate',
        'type' => 'number',
        'label' => __('avored::system.conversation-rate'),
        'value' => $currency->conversation_rate ?? '',
        'attrs' => [
            'step' => '0.0001'
        ]
    ])
</div>


<div class="mt-3 w-full">
    @include('avored::system.form.toggle', [
        'name' => 'status',
        'label' => __('avored::system.status'),
        'value' => $currency->status ?? '',
        'checkedValue' => 'ENABLED',
        'unCheckedValue' => 'DISABLED',
    ])
</div>
