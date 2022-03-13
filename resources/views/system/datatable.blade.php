
<x-avored::table>
    <x-slot name="header">
        <x-avored::table.row class="bg-gray-300">
            @foreach ($columns as $column)
                <x-avored::table.header class="rounded-tl">
                    {{ __('avored::system.' . $column['identifier']) }}
                </x-avored::table.header>
            @endforeach
        </x-avored::table.row>
    </x-slot>
    <x-slot name="body">
        @foreach ($categories as $category)
            <x-avored::table.row class="{{ ($loop->index % 2 == 0) ? '' : 'bg-gray-200'  }}">
                <x-avored::table.cell>
                    {{ $category->parent->name ?? '' }}
                </x-avored::table.cell>
                <x-avored::table.cell>
                    {{ $category->name ?? '' }}
                </x-avored::table.cell>
                <x-avored::table.cell>
                    {{ $category->slug ?? '' }}
                </x-avored::table.cell>
                <x-avored::table.cell>
                    {{ $category->meta_title ?? '' }}
                </x-avored::table.cell>
                <x-avored::table.cell>
                    {{ $category->meta_description ?? '' }}
                </x-avored::table.cell>
                <x-avored::table.cell>
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
                </x-avored::table.cell>
            </x-avored::table.row>
        @endforeach
    </x-slot>
</x-avored::table>
