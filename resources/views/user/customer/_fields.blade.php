<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.first_name') }}"
        field-name="first_name"
        init-value="{{ $customer->first_name ?? '' }}" 
        error-text="{{ $errors->first('first_name') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.last_name') }}"
        field-name="last_name"
        init-value="{{ $customer->last_name ?? '' }}" 
        error-text="{{ $errors->first('last_name') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.email') }}"
        field-name="email"
        :is-disabled="true"
        init-value="{{ $customer->email ?? '' }}" 
        error-text="{{ $errors->first('email') }}"
    >
    </avored-input>
</div>
