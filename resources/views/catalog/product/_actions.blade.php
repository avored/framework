<div class="flex">
    <x-avored::link url="{{ route('admin.product.edit', $product) }}">
        <i class="w-5 h-5" data-feather="edit"></i>
    </x-avored::link>
    <span class="mx-2">|</span>
    <x-avored::link
        x-on:click.prevent="toggleConfirmationDialog(
            true,
            {{ $product }},
            '{{ __('avored::system.confirmation_delete_message', ['attribute_value' => $product->name, 'attribute' => strtolower(__('avored::system.product'))]) }}',
            '{{ route('admin.product.destroy', $product) }}'
        )"
        url="{{ route('admin.product.destroy', $product) }}">
        <i class="w-5 h-5" data-feather="trash"></i>
        <x-avored::form.form
            id="product-destory-{{ $product->id }}"
            method="delete"
            action="{{ route('admin.product.destroy', $product) }}">
        </x-avored::form.form>
    </x-avored::link>
</div>
