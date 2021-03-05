@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.create') . ' ' . __('avored::system.category') }}: AvoRed E commerce Admin Dashboard
@endsection


@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.create') . ' ' . __('avored::system.category') }}
        </div>
    </div>
@endsection


@section('content')
<div class="mt-3">        
    <form action="{{ route('admin.category.store') }}"  method="post">
        @csrf
        <div class="flex" x-data="avoredTabs()" x-init="tabInit('{{ $tabs->first()->key() }}')">
            <ul role="tablist" class="w-32 border-r border-gray-200">
                @foreach ($tabs as $tab)
                    <li
                        x-bind:class="tab == '{{ $tab->key() }}' ? 'text-primary' : ''"
                        class="mt-3 border-b border-gray-200"
                        role="presentation"
                        {{-- x-show="tab.isVisible" --}}
                    >
                        <a
                            x-on:click.prevent="tab = '{{ $tab->key() }}'; window.location.hash = '{{ $tab->key() }}'" 
                            href="'#' + {{ $tab->key() }}"
                            class="bg-white inline-block py-2 px-4 text-blue-dark font-semibold"
                            role="tab"
                            >
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
        
      
        {{-- <avored-tabs>
            @foreach ($tabs as $tab)
                <avored-tab identifier="{{ $tab->key() }}" name="{{ $tab->label() }}">
                    @php
                        $path = $tab->view();
                    @endphp
                    @include($path)
                </avored-tab>
            @endforeach
        </avored-tabs> --}}
            
        <div class="mt-3 py-3">
            @include('avored::partials.forms.action-buttons', ['url' => route('admin.category.index')])
        </div>
    </form>
</div>
@endsection
