<a-form-item
    @if ($errors->has('name'))
        validate-status="error"
        help="{{ $errors->first('name') }}"
    @endif
    label="{{ __('avored::catalog.category.name') }}"
>
    <a-input
        :auto-focus="true"
        name="name"
        v-decorator="[
        'name',
        {'initialValue': '{{ $category->name ?? '' }}'},
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
<a-form-item
    @if ($errors->has('slug'))
        validate-status="error"
        help="{{ $errors->first('slug') }}"
    @endif
    label="{{ __('avored::catalog.category.slug') }}"
>
    <a-input
        :auto-focus="true"
        name="slug"
        v-decorator="[
        'code',
        {'initialValue': '{{ $category->slug ?? '' }}'},
        {rules: 
            [
                {   required: true, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Slug']) }}' 
                }
            ]
        }
        ]"
    ></a-input>

</a-form-item>


<a-form-item
    @if ($errors->has('meta_title'))
        validate-status="error"
        help="{{ $errors->first('meta_title') }}"
    @endif
    label="{{ __('avored::catalog.category.meta_title') }}"
>
    <a-input
        :auto-focus="true"
        name="meta_title"
        v-decorator="[
        'meta_title',
        {'initialValue': '{{ $category->meta_title ?? '' }}'},
        {rules: 
            [
                {   required: false, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'Meta Title']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>
<a-form-item
    @if ($errors->has('meta_description'))
        validate-status="error"
        help="{{ $errors->first('meta_description') }}"
    @endif
    label="{{ __('avored::catalog.category.meta_description') }}"
>
    <a-input
        :auto-focus="true"
        name="meta_description"
        v-decorator="[
        'meta_description',
        {'initialValue': '{{ $category->meta_description ?? '' }}'},
        {rules: 
            [
                {   required: false, 
                    message: '{{ __('avored::validation.required', ['attribute' => 'meta_description']) }}' 
                }
            ]
        }
        ]"
    ></a-input>
</a-form-item>
