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
<div class="mt-3">
    <x-avored::form.input
        name="name"
        value="{{ $category->name ?? '' }}"
        label="{{ __('avored::system.name') }}"
    ></x-avored::form.input>
</div>

<div class="mt-3">
    <x-avored::form.input
        name="slug"
        value="{{ $category->slug ?? '' }}"
        label="{{ __('avored::system.slug') }}"
    ></x-avored::form.input>
</div>

<div class="mt-3">
    <x-avored::form.input
        name="description"
        value="{{ $category->description ?? '' }}"
        label="{{ __('avored::system.description') }}"
    ></x-avored::form.input>
</div>

<div class="mt-3">
    <x-avored::form.input
        name="meta_title"
        value="{{ $category->meta_title ?? '' }}"
        label="{{ __('avored::system.meta_title') }}"
    ></x-avored::form.input>
</div>

<div class="mt-3">
    <x-avored::form.input
        name="meta_description"
        value="{{ $category->meta_description ?? '' }}"
        label="{{ __('avored::system.meta_description') }}"
    ></x-avored::form.input>
</div>
