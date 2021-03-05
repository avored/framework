@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.edit', ['attribute' => __('avored::system.terms.role')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.edit', ['attribute' => __('avored::system.terms.role')]) }}
        </div>
    </div>

@endsection

@section('content')
<div class="items-center block w-full">  
    <form method="post" action="{{ route('admin.role.update', $role->id) }}">
            @csrf
            @method('put')

            <avored-tabs>
                @foreach ($tabs as $tab)
                    <avored-tab identifier="{{ $tab->key() }}" name="{{ $tab->label() }}">
                        @php
                            $path = $tab->view();
                        @endphp
                        @include($path)
                    </avored-tab>
                @endforeach
            </avored-tabs>
        
            <div class="mt-3 py-3">
                @include('avored::partials.forms.action-buttons', ['url' => route('admin.role.index')])
            </div>
    </form>
</div>
@endsection
