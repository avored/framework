@php
    $attrs = (isset($attrs)) ? $attrs : [];
    $value = $value ?? null;
@endphp
<div class="w-full">
    <label for="{{ $name }}"
        class="block text-sm leading-5 text-gray-500">
           {{ $label }}
    </label>
    <div class="mt-1">
        <div class="relative flex items-center">
            <input
                id="{{ $name }}"
                type="{{ $type ?? 'text' }}"
                @foreach ($attrs as $attrKey => $attrVal)
                    {{ $attrKey }}="{{ $attrVal }}"
                @endforeach
                name="{{ $name }}"
                value="{{ $value }}"
                placeholder="{{ $placeholder ?? '' }}"
                class="px-3 flex-1 w-full py-2 outline-none shadow-sm focus:shadow focus:border rounded border block border-gray-200"
                {{ isset($isDisabled) ? 'disabled' : '' }} />
        </div>

        @if ($errors->has($name))
            <p class="text-sm italic text-red-500">
                {{ $errors->first($name) }}
            </p>
        @endif
    </div>
</div>
