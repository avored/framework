@switch($style)
    @case('normal')
        <a 
            class="text-gray-600 hover:text-red-600 {{ $class }}" 
            href="{{ $url }}"
            {{ $attributes }}
        >
            {{ $slot }}
        </a>
        @break
    @case('button')
        <a 
            class="bg-red-700 text-white px-4 py-2 rounded shadow-sm hover:bg-red-600 {{ $class }}" 
            href="{{ $url }}"
            {{ $attributes }}
        >
            {{ $slot }}
        </a>
        @break
    @default
        
@endswitch