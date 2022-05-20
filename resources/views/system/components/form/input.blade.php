<div class="w-full block">
    @if ($label)
    <label for="{{ $name }}" class="text-gray-600 font-semibold text-sm block">
        {{ $label }}
    </label>
    @endif
    <div class="relative mb-5">
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge([
                'autofocus' => false,
            ]) }} class="avored-input {{ ($errors->has($name)) ? 'ring-red-400' : '' }} {{ $class }}" />
        @if ($errors->has($name))
        <div class="text-xs absolute text-red-400">
            {{ $errors->first($name) }}
        </div>
        @endif
    </div>
</div>

{{-- ring-1 ring-gray-300 px-3 py-2 w-full rounded focus:outline-none focus:ring-red-500  --}}
