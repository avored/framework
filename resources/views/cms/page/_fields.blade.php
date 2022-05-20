<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="name"
                value="{{ $page->name ?? '' }}"
                label="{{ __('avored::system.name') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="slug"
                value="{{ $page->slug ?? '' }}"
                label="{{ __('avored::system.slug') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>


<div class="mt-3">
    <x-avored::form.easymde
        name="content"
        value="{{ $page->content ?? '' }}"
        label="{{ __('avored::system.content') }}"
    ></x-avored::form.easymde>
</div>

<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="meta_title"
                value="{{ $page->meta_title ?? '' }}"
                label="{{ __('avored::system.meta_title') }}"
            ></x-avored::form.input>
        </div>
    </div>

    <div class="w-1/2 ml-3">
        <div class="mt-3">
            <x-avored::form.input
                name="meta_description"
                value="{{ $page->meta_description ?? '' }}"
                label="{{ __('avored::system.meta_description') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>
