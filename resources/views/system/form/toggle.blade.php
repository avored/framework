<?php 
$checkedValue = isset($checkedValue) ? $checkedValue : true;
$unCheckedValue = isset($unCheckedValue) ? $unCheckedValue :  false;
$value = (isset($value)) ? $value : $unCheckedValue; 
?>
<div class="w-full block">
    <label for="toggle" class=" text-sm mb-3 block w-full text-gray-500">
        {{ $label }}
    </label>
    <div class="block w-full">
        <div 
            x-data="avoredToggle()"
            x-init="initToggle('{{ $checkedValue }}', '{{ $unCheckedValue }}', '{{ $value }}')"
            class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
            <input 
                type="checkbox" 
                name="{{ $name }}"
                x-on:change="toggleChangeEvent($event)"
                x-bind:value="value"
                x-bind:checked="(value === checkedValue)"
                x-bind:class="(value === checkedValue) ? 'bg-primary right-0' : ''"
                id="toggle" 
                class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 border-red-500 outline-none appearance-none cursor-pointer"/>
            <label
                for="toggle" 
                x-bind:class="(value === checkedValue) ? 'bg-gray-300' : ''"
                class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer">
            </label>
        </div>
    </div>
</div>
