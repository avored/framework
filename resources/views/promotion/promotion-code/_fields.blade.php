<a-row :gutter="20">
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('name'))
                validate-status="error"
                help="{{ $errors->first('name') }}"
            @endif
            label="{{ __('avored::promotion.promotion-code.name') }}">
            <a-input
                :auto-focus="true"
                name="name"
                v-decorator="[
                'name',
                {initialValue: '{{ ($promotionCode->name) ?? '' }}' },
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>

    <a-col :span="12">    
        <a-form-item
                @if ($errors->has('description'))
                    validate-status="error"
                    help="{{ $errors->first('description') }}"
                @endif
                label="{{ __('avored::promotion.promotion-code.description') }}"
            >
                <a-input
                    name="description"
                    v-decorator="[
                    'description',
                    {initialValue: '{{ ($promotionCode->description) ?? '' }}' },
                    {rules: 
                        [
                            {   required: true, 
                                message: '{{ __('avored::validation.required', ['attribute' => 'description']) }}' 
                            }
                        ]
                    }
                    ]"
                ></a-input>
            </a-form-item>
    </a-col>
</a-row>

<a-row :gutter="20">
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('code'))
                validate-status="error"
                help="{{ $errors->first('code') }}"
            @endif
            label="{{ __('avored::promotion.promotion-code.code') }}">
            <a-input
                name="code"
                v-decorator="[
                'code',
                {initialValue: '{{ ($promotionCode->code) ?? '' }}' },
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'code']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('status'))
                validate-status="error"
                help="{{ $errors->first('status') }}"
            @endif
            label="{{ __('avored::promotion.promotion-code.status') }}"
        >
            <a-switch 
                {{ (isset($promotionCode) && $promotionCode->status) ? 'default-checked' : '' }}
                @change="changeStatus"></a-switch>
        </a-form-item>

        <input type="hidden" name="status" v-model="status" />
    </a-col>
</a-row>


<a-row :gutter="20">
    <a-col :span="12">
        <a-form-item
            @if ($errors->has('type'))
                validate-status="error"
                help="{{ $errors->first('language') }}"
            @endif
            label="{{ __('avored::promotion.promotion-code.type') }}"
        >
            <a-select
                v-on:change="handleTypeChange"
                v-decorator="[
                'type',
                {initialValue: '{{ ($promotionCode->type) ?? '' }}' },
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'Promotion Code Type']) }}' 
                        }
                    ]
                }
                ]"
            >
                @foreach ($typeOptions as $typeOptionVal => $typeOptionLabel)        
                    <a-select-option value="{{ $typeOptionVal }}">{{ $typeOptionLabel }}</a-select-option>
                @endforeach
            </a-select>
        </a-form-item>
        <input type="hidden" v-model="type" name="type"  />
    </a-col>

    <a-col :span="12">
        <a-form-item
            @if ($errors->has('amount'))
                validate-status="error"
                help="{{ $errors->first('amount') }}"
            @endif
            label="{{ __('avored::promotion.promotion-code.amount') }}"
        >
            <a-input
                name="amount"
                v-decorator="[
                'amount',
                {initialValue: '{{ ($promotionCode->amount) ?? '' }}' },
                {rules: 
                    [
                        {   required: true, 
                            message: '{{ __('avored::validation.required', ['attribute' => 'amount']) }}' 
                        }
                    ]
                }
                ]"
            ></a-input>
        </a-form-item>
    </a-col>
</a-row>


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
