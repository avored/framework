<div class="mt-3">
    <x-avored::form.select
        name="parent_id"
        autofocus
        label="{{ __('avored::system.parent') }}"
    >

        <option value="">{{ __('avored::system.please_select') }}</option>
        @foreach ($options as $optionValue => $optionLabel)
            <option {{ (isset($category) && $category->parent_id === $optionValue)  ? 'selected' : ''}} value="{{ $optionValue }}">
                {{ $optionLabel }}
            </option>
        @endforeach

    </x-avored::form.select>
</div>

<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="name"
                value="{{ $category->name ?? '' }}"
                label="{{ __('avored::system.name') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="slug"
                value="{{ $category->slug ?? '' }}"
                label="{{ __('avored::system.slug') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>


<div class="mt-3">
    <x-avored::form.easymde
        name="description"
        value="{{ $category->description ?? '' }}"
        label="{{ __('avored::system.description') }}"
    ></x-avored::form.easymde>
</div>

<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="meta_title"
                value="{{ $category->meta_title ?? '' }}"
                label="{{ __('avored::system.meta_title') }}"
            ></x-avored::form.input>
        </div>
    </div>

    <div class="w-1/2 ml-3">
        <div class="mt-3">
            <x-avored::form.input
                name="meta_description"
                value="{{ $category->meta_description ?? '' }}"
                label="{{ __('avored::system.meta_description') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>
