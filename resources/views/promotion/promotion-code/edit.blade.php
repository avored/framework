@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.common.edit') . ' ' . __('avored::system.terms.promotion_code') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.common.edit') . ' ' . __('avored::system.terms.promotion_code') }}
        </div>
    </div>
@endsection


@section('content')
<div class="flex items-center">
    <form method="post" action="{{ route('admin.promotion-code.update', $promotionCode->id) }}">
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
            @include('avored::partials.forms.action-buttons', ['url' => route('admin.promotion-code.index')])
        </div>
    </form>
</div>
@endsection
