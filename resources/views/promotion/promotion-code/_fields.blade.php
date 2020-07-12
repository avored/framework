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
        
        <label>
            {{ __('avored::promotion.promotion-code.active_from') }}
        </label>
        <a-date-picker :default-value="activeFromDefault" :format="dateFormat" @change="onActiveFromChange"></a-date-picker>
        <input type="hidden" v-model="activeFrom" name="active_from"  />

    </div>
    <div class="w-1/2 ml-3">
         <label>
            {{ __('avored::promotion.promotion-code.active_till') }}
        </label>
        <a-date-picker :default-value="activeTillDefault" :format="dateFormat" @change="onActiveTillChange"></a-date-picker>
        <input type="hidden" v-model="activeTill" name="active_till"  />
    </div>
</div>
