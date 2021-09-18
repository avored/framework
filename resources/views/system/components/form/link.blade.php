@switch($style)
    @case('normal')
        <a {{ $attributes }} class="text-gray-600 hover:text-red-600 {{ $class }}" href="{{ $url }}">
            {{ $slot }}
        </a>
        @break
    @case('button-primary')
        <a {{ $attributes }}
            class="bg-red-700 text-white px-4 py-2 rounded shadow-sm hover:bg-red-600 {{ $class }}"
            href="{{ $url }}"
        >
            {{ $slot }}
        </a>
        @break
    @case('button-default')
        <a {{ $attributes }}
            class="bg-gray-500 text-white px-4 py-2 rounded shadow-sm hover:bg-gray-400 {{ $class }}"
            href="{{ $url }}">
            {{ $slot }}
        </a>
        @break
    @default

@endswitch
