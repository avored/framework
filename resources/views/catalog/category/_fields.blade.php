<div class="flex w-full">
    @include('avored::system.form.select', [
        'name' => 'parent_id',
        'label' => __('avored::system.parent_id'),
        'value' => $category->parent_id ?? '',
        'options' => $categoryOptions
    ])

</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'name',
        'label' => __('avored::system.name'),
        'value' => $category->name ?? ''
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'slug',
        'label' => __('avored::system.slug'),
        'value' => $category->slug ?? ''
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'meta_title',
        'label' => __('avored::system.meta_title'),
        'value' => $category->meta_title ?? ''
    ])
</div>

<div class="flex mt-3 w-full">
    @include('avored::system.form.input', [
        'name' => 'meta_description',
        'label' => __('avored::system.meta_description'),
        'value' => $category->meta_description ?? ''
    ])
</div>
