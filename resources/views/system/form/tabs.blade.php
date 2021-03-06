<div class="flex" x-data="avoredTabs()" 
    x-init="tabInit('{{ $tabs->first()->key() }}')">
    <ul role="tablist" class="w-32 border-r border-gray-200">
        @foreach ($tabs as $tab)
            <li x-bind:class="tab == '{{ $tab->key() }}' ? 'text-primary' : ''" 
                class="mt-3 border-b border-gray-200">
                <a x-on:click.prevent="tab = '{{ $tab->key() }}'; window.location.hash = '{{ $tab->key() }}'" 
                    href="'#' + {{ $tab->key() }}"
                    class="bg-white inline-block py-2 px-4 text-blue-dark font-semibold">
                    {{ $tab->label() }}
                </a>
            </li>
        @endforeach
    </ul>
    <div class="flex-1 p-4">
        @foreach ($tabs as $tab)
            <div class="block w-full" x-show="tab === '{{ $tab->key() }}'">
                @php
                    $path = $tab->view();
                @endphp
                @include($path)
            </div>
        @endforeach
    </div>
</div>
