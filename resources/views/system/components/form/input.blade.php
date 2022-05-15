<div class="w-full block">
    @if ($label)
    <label for="{{ $name }}" class="text-gray-600 font-semibold text-sm block">
        {{ $label }}
    </label>
    @endif
    <div class="relative mb-5">
        <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" {{ $attributes->merge([
                'autofocus' => false,
            ]) }} class="form-input w-full ring-red-100 rounded {{ ($errors->has($name)) ? 'ring-red-400' : '' }} {{ $class }}" />
        @if ($errors->has($name))
        <div class="text-xs absolute text-red-400">
            {{ $errors->first($name) }}
        </div>
        @endif
    </div>
</div>
