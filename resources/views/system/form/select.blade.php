<div x-data="avoredDropdownHandler('{{ $value }}', '{{ json_encode($options) }}')"
    x-init="dropdownInit()"
    class="w-full cursor-pointer">
  <label id="{{ $name }}" class="block text-sm font-medium text-gray-700">
    {{ $label }}
  </label>
    <input type="hidden" name="{{ $name }}" x-bind:value="fieldValue" />
  <div class="mt-1 relative">
    <button type="button" 
        aria-haspopup="listbox" 
        x-on:click="dropdownIsOpen=!dropdownIsOpen"
        aria-expanded="true" 
        aria-labelledby="{{ $name }}" 
        class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left focus:outline-none sm:text-sm">
      <span class="flex items-center">
            <span x-html="selectedLabel"></span>
      <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
          <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
      </span>
    </button>
    
    <div x-show="dropdownIsOpen"  class="absolute z-10 mt-1 w-full rounded-md bg-white shadow-lg">
      <ul tabindex="-1" role="listbox" 
        aria-labelledby="{{ $name }}" 
        aria-activedescendant="listbox-item-3" 
        class="max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
        @foreach ($options as $optionValue => $optionLabel)
            <li id="listbox-item-0" 
                role="option" 
                x-on:click="optionClicked('{{ $optionValue }}')"
                class="text-gray-900 hover:text-white hover:bg-primary select-none relative py-2 pl-3 pr-9">
                <div class="flex items-center">
                    {{ $optionLabel }}
                </div>
            <span 
                class="absolute hover:text-white inset-y-0 right-0 flex items-center pr-4"
                x-bind:class="isCheckboxVisible('{{ $optionValue }}')">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
            </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
