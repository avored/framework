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

<a-row>
    <a-col :span="12">
        <a-form-item
        @if ($errors->has('active_from'))
            validate-status="error"
            help="{{ $errors->first('active_from') }}"
        @endif
        label="{{ __('avored::promotion.promotion-code.active_from') }}">
            <a-date-picker :default-value="activeFromDefault" :format="dateFormat" @change="onActiveFromChange"></a-date-picker>
    </a-form-item>
    <input type="hidden" v-model="activeFrom" name="active_from"  />
    </a-col>
    <a-col :span="12">
        <a-form-item
        @if ($errors->has('active_till'))
            validate-status="error"
            help="{{ $errors->first('active_till') }}"
        @endif
        label="{{ __('avored::promotion.promotion-code.active_till') }}">
            <a-date-picker :default-value="activeTillDefault" :format="dateFormat" @change="onActiveTillChange"></a-date-picker>
    </a-form-item>
    <input type="hidden" v-model="activeTill" name="active_till"  />
    </a-col>
</a-row>
