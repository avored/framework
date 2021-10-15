

<div class="cursor-pointer flex w-full"
    x-data="toggle"
    x-init="init('{{ $value }}', '{{ $checkedValue }}', '{{ $unCheckedValue }}')"
    x-on:click="toggle">
    <div class="w-10 h-6 rounded-full flex items-center justify-items-start my-1"
        x-bind:class="value === checkedValue ? 'bg-red-600' : 'bg-gray-500'">
        <div class="absolute w-4 h-4 rounded-full bg-white"
            x-bind:class="value === checkedValue ? 'ml-5' : 'ml-1'"></div>
    </div>
    <span class="text-gray-600 mt-1 ml-3">{{ $label }}</span>
    <input
        type="hidden"
        name="{{ $name }}"
        x-bind:value="value"
    />
</div>
