<div class="mt-3">
    <x-avored::form.upload
        name="images[]"
        multiple="true"
        value="{{ (isset($product) && isset($product->document) && $product->document)  ? $product->document : '' }}"
        label="{{ __('avored::system.image_path') }}"
    ></x-avored::form.upload>
</div>
