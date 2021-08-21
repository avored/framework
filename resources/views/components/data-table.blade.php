<div class="w-full block">
    <table class="avored-table w-full">
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
    </table>
</div>
