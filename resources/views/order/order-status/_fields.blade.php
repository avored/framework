


<avored-form-input 
    field-name="name"
    label="Name" 
    field-value="{!! $model->name ?? "" !!}" 
    error-text="{!! $errors->first('name') !!}"
    v-on:change="changeModelValue"
    autofocus="autofocus"
        >
</avored-form-input>

<avored-form-select 
    field-name="is_default"
    label="Is Default" 
    field-value="{!! $model->is_default ?? "" !!}" 
    error-text="{!! $errors->first('is_default') !!}"
    v-on:change="changeModelValue"
    field-options='{!! $isDefaultOptions !!}'
    autofocus="autofocus"
        >
</avored-form-select>

