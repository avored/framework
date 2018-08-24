


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

<avored-form-input 
    field-name="phone_code"
    label="Phone Code" 
    field-value="{!! $model->phone_code ?? "" !!}" 
    error-text="{!! $errors->first('phone_code') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>

<avored-form-input 
    field-name="lang_code"
    label="Language Code" 
    field-value="{!! $model->lang_code ?? "" !!}" 
    error-text="{!! $errors->first('lang_code') !!}"
    v-on:change="changeModelValue"
        >
</avored-form-input>
