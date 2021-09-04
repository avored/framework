<td class="px-3 py-2">
    @if (isset($value))
        {{ $value }}
    @else
        {{ $slot }}
    @endif
</td>
