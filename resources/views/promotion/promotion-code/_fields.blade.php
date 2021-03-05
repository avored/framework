<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'name',
        'label' => __('avored::system.name'),
        'value' => $promotionCode->name ?? ''
    ])
</div>


<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'description',
        'label' => __('avored::system.description'),
        'value' => $promotionCode->description ?? ''
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'code',
        'label' => __('avored::system.code'),
        'value' => $promotionCode->code ?? ''
    ])
</div>


<div class="flex mt-3 w-full">
    @include('avored::system.form.toggle', [
        'name' => 'status',
        'label' => __('avored::system.status'),
        'value' => $customerGroup->status ?? null
    ])
</div>


<div class="flex mt-3 w-full">
    @include('avored::system.form.select', [
        'name' => 'type',
        'label' => __('avored::system.type'),
        'value' => $promotionCode->type ?? '',
        'options' => $typeOptions
    ])
</div>

    
<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'amount',
        'label' => __('avored::system.amount'),
        'value' => $customerGroup->amount ?? null
    ])
</div>

<div class="flex mt-3 items-center">
    <div class="w-1/2">
        <div class="flex mt-3 w-full">
            @include('avored::system.form.input', [
                'name' => 'active_from',
                'type' => 'date',
                'label' => __('avored::system.active-from'),
                'value' => $customerGroup->active_from ?? null
            ])
        </div>
    </div>
    <div class="w-1/2 ml-3">
        <div class="flex mt-3 w-full">
            @include('avored::system.form.input', [
                'name' => 'active_till',
                'type' => 'date',
                'label' => __('avored::system.active-till'),
                'value' => $customerGroup->active_till ?? null
            ])
        </div>
    </div>
</div>
