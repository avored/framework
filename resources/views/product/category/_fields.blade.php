<avored-form-input
    field-name="name"
    label="Nome da Categoria {{ __('avored-framework::product.category_name') }}"
    field-value="{!! $model->name ?? "" !!}"
    error-text="{!! $errors->first('name') !!}"
    v-on:change="changeModelValue"
    autofocus="autofocus"
        >
</avored-form-input>

{{--<avored-form-input --}}
    {{--field-name="slug"--}}
    {{--label="{{ __('avored-framework::product.category_name') }} Slug"--}}
    {{--field-value="{!! $model->slug ?? "" !!}" --}}
    {{--error-text="{!! $errors->first('slug') !!}"--}}
    {{--v-on:change="changeModelValue"--}}
        {{-->--}}
{{--</avored-form-input>--}}


<avored-form-select
    field-name="parent_id"
    label="{{ __('avored-framework::product.category_name') }} Pai"
    error-text="{!! $errors->first('parent_id') !!}"
    field-options='{!! $categoryOptions !!}'
    field-value="{!! $model->parent_id ?? "" !!}"
    v-on:change="changeModelValue"
        >
</avored-form-select>
