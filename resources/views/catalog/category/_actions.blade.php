<div class="flex">
    <x-avored::link url="{{ route('admin.category.edit', $category) }}">
        <i class="w-5 h-5" data-feather="edit"></i>
    </x-avored::link>
    <span class="mx-2">|</span>
    <x-avored::link
        x-on:click.prevent="toggleConfirmationDialog(
            true,
            {{ $category }},
            '{{ __('avored::system.confirmation_delete_message', ['attribute_value' => $category->name, 'attribute' => strtolower(__('avored::system.category'))]) }}',
            '{{ route('admin.category.destroy', $category) }}'
        )"
        url="{{ route('admin.category.destroy', $category) }}">
        <i class="w-5 h-5" data-feather="trash"></i>
        <x-avored::form.form
            id="category-destory-{{ $category->id }}"
            method="delete"
            action="{{ route('admin.category.destroy', $category) }}">
        </x-avored::form.form>
    </x-avored::link>
</div>
