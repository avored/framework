<div class="w-full flex">

    <x-avored-table class="flex-col space-y-3" :columns="$columns">
        <x-slot name="head">
            @foreach ($columns as $column)
                <x-avored-table-header>
                    {{ $column->label() }}
                </x-avored-table-header>
            @endforeach
        </x-slot>
        <x-slot name="body">
            @foreach ($items as $item)
                <x-avored-table-row class="{{ ($loop->index % 2 == 0) ? 'bg-gray-100' : 'bg-white'  }}">
                    @foreach ($columns as $column)
                        <x-avored-table-cell :column="$column" :item="$item">
                            Row 1 Columns 1
                        </x-avored-table-cell>
                    @endforeach
                </x-avored-table-row>
            @endforeach

        </x-slot>
    </x-avored-table>
    {{-- <table class="avored-table w-full">
        <thead class="">
            <tr class="bg-gray-300">
                @foreach ($columns as $column)
                    @if ($column->visible())
                    <th class="p-3 text-left">
                        <span class="text-gray-600 font-semibold">
                            {{ $column->label() }}
                        </span>
                    </th>
                    @endif
                @endforeach
            </tr>
        </thead>
        <tbody class="bg-gray-200">
            @foreach ($items as $item)
                <tr class="bg-white text-left border-b-2 border-gray-200">
                    @foreach ($columns as $column)
                        @if ($column->visible())
                            <td class="p-3">
                                <span>{{ $column->render($item) }}</span>
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table> --}}
</div>
