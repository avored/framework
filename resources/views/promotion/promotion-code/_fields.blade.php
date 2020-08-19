<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $promotionCode->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.description') }}"
        field-name="description"
        init-value="{{ $promotionCode->description ?? '' }}" 
        error-text="{{ $errors->first('description') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.code') }}"
        field-name="code"
        init-value="{{ $promotionCode->code ?? '' }}" 
        error-text="{{ $errors->first('code') }}"
    >
    </avored-input>
</div>


<div class="mt-3 flex w-full">
    <avored-toggle
        label-text="{{ __('avored::system.fields.status') }}"
        error-text="{{ $errors->first('status') }}"
        field-name="status"
        init-value="{{ $promotionCode->status ?? '' }}"
    >
    </avored-toggle>
</div>


<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.type') }}"
        field-name="type"
        error-text="{{ $errors->first('type') }}"
        :options="{{ json_encode($typeOptions) }}"
        init-value="{{ $promotionCode->type ?? '' }}"
    >
    </avored-select>
</div>

    
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.amount') }}"
        field-name="amount"
        init-value="{{ $promotionCode->amount ?? '' }}" 
        error-text="{{ $errors->first('amount') }}"
    >
    </avored-input>
</div>

<div class="flex mt-3 items-center">
    <div class="w-1/2">
        
        <avored-input
            label-text="{{ __('avored::system.fields.active_from') }}"
            field-name="active_from"
            input-type="date"
            init-value="{{ (isset($promotionCode)) ? $promotionCode->active_from->format('Y-m-d') : '' }}"
            error-text="{{ $errors->first('active_from') }}"
        >
        </avored-input>
    </div>
    <div class="w-1/2 ml-3">
        <avored-input
        label-text="{{ __('avored::system.fields.active_till') }}"
        field-name="active_till"
        input-type="date"
        init-value="{{ (isset($promotionCode)) ? $promotionCode->active_till->format('Y-m-d') : '' }}"
        error-text="{{ $errors->first('active_till') }}"
    >
    </avored-input>
    </div>
</div>
