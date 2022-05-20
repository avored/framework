<input
    class="my-auto transform hover:scale-110"
    type="checkbox"
    id="{{ $name }}"
    name="{{ $name }}"
    value="{{ $checkedValue }}"
    {{ $value ? 'checked' : '' }}
    {{ $attributes }}
/>
<label for="{{ $name }}" class="ml-3 text-gray-600">{{ $label }}</label>
