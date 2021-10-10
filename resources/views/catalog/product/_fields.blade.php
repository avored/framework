<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="name"
                autofocus
                value="{{ $product->name ?? '' }}"
                label="{{ __('avored::system.name') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="slug"
                value="{{ $product->slug ?? '' }}"
                label="{{ __('avored::system.slug') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>
<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="sku"
                value="{{ $product->sku ?? '' }}"
                label="{{ __('avored::system.sku') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="barcode"
                value="{{ $product->barcode ?? '' }}"
                label="{{ __('avored::system.barcode') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>


<div class="mt-3">
    <x-avored::form.easymde
        name="description"
        value="{{ $product->description ?? '' }}"
        label="{{ __('avored::system.description') }}"
    ></x-avored::form.easymde>
</div>

<div class="flex w-full">
    <div class="w-1/3">
        <div class="mt-3">
            <x-avored::form.input
                name="qty"
                value="{{ $product->qty ?? '' }}"
                label="{{ __('avored::system.qty') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/3">
        <div class="mt-3">
            <x-avored::form.input
                name="price"
                value="{{ $product->price ?? '' }}"
                label="{{ __('avored::system.price') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/3">
        <div class="mt-3">
            <x-avored::form.input
                name="cost_price"
                value="{{ $product->cost_price ?? '' }}"
                label="{{ __('avored::system.cost_price') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>

<div class="flex w-full">
    <div class="w-1/4">
        <x-avored::form.checkbox
            name="status"
            value="{{ $product->status ?? '' }}"
            label="{{ __('avored::system.status') }}"
        ></x-avored::form.checkbox>
    </div>
    <div class="w-1/4">
        <x-avored::form.checkbox
            name="is_taxable"
            value="{{ $product->is_taxable ?? '' }}"
            label="{{ __('avored::system.is_taxable') }}"
        ></x-avored::form.checkbox>
    </div>
    <div class="ml-3 w-1/4">
        <x-avored::form.checkbox
            name="in_stock"
            value="{{ $product->in_stock ?? '' }}"
            label="{{ __('avored::system.in_stock') }}"
        ></x-avored::form.checkbox>
    </div>
    <div class="ml-3 w-1/4">
        <x-avored::form.checkbox
            name="track_stock"
            value="{{ $product->track_stock ?? '' }}"
            label="{{ __('avored::system.track_stock') }}"
        ></x-avored::form.checkbox>
    </div>
</div>
<div class="flex w-full">
    <div class="w-1/4">
        <div class="mt-3">
            <x-avored::form.input
                name="weight"
                value="{{ $product->weight ?? '' }}"
                label="{{ __('avored::system.weight') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/4">
        <div class="mt-3">
            <x-avored::form.input
                name="width"
                value="{{ $product->width ?? '' }}"
                label="{{ __('avored::system.width') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/4">
        <div class="mt-3">
            <x-avored::form.input
                name="height"
                value="{{ $product->height ?? '' }}"
                label="{{ __('avored::system.height') }}"
            ></x-avored::form.input>
        </div>
    </div>
    <div class="ml-3 w-1/4">
        <div class="mt-3">
            <x-avored::form.input
                name="length"
                value="{{ $product->length ?? '' }}"
                label="{{ __('avored::system.length') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>



<div class="flex w-full">
    <div class="w-1/2">
        <div class="mt-3">
            <x-avored::form.input
                name="meta_title"
                value="{{ $product->meta_title ?? '' }}"
                label="{{ __('avored::system.meta_title') }}"
            ></x-avored::form.input>
        </div>
    </div>

    <div class="w-1/2 ml-3">
        <div class="mt-3">
            <x-avored::form.input
                name="meta_description"
                value="{{ $product->meta_description ?? '' }}"
                label="{{ __('avored::system.meta_description') }}"
            ></x-avored::form.input>
        </div>
    </div>
</div>
