


<avored-form-input 
    field-name="name"
    label="Name" 
    field-value="{!! $model->name ?? "" !!}" 
    error-text="{!! $errors->first('name') !!}"
    v-on:change="changeModelValue"
    autofocus="autofocus"
        >
</avored-form-input>

<avored-form-input 
    field-name="code"
    label="Code" 
    field-value="{!! $model->code ?? "" !!}" 
    error-text="{!! $errors->first('code') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>


<avored-form-select 
    field-name="country_id"
    label="Country" 
    field-value="{!! $model->country_id ?? "" !!}" 
    error-text="{!! $errors->first('country_id') !!}"
    v-on:change="changeModelValue"
    field-options='{!! $countryOptions !!}'
        >
</avored-form-select>
