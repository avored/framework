<div class="flex w-full">
    <avored-select
        label-text="{{ __('avored::system.parent_id') }}"
        field-name="parent_id"
        :options="{{ $categoryOptions }}"
        init-value="{{ $category->parent_id ?? '' }}" 
        error-text="{{ $errors->first('parent_id') }}"
        :has-empty="true"
    >
    </avored-select>
</div>

<div class="flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $category->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    >
    </avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.slug') }}"
        field-name="slug"
        init-value="{{ $category->slug ?? '' }}" 
        error-text="{{ $errors->first('slug') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.meta_title') }}"
        field-name="meta_title"
        init-value="{{ $category->meta_title ?? '' }}" 
        error-text="{{ $errors->first('meta_title') }}"
    >
    </avored-input>
</div>
<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.meta_description') }}"
        field-name="meta_description"
        init-value="{{ $category->meta_description ?? '' }}" 
        error-text="{{ $errors->first('meta_description') }}"
    >
    </avored-input>
</div>
