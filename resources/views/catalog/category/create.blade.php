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
        @include('avored::system.form.tabs')
    
        <div class="mt-3 py-3">
            @include('avored::partials.forms.action-buttons', ['url' => route('admin.category.index')])
        </div>
    </form>
</div>
@endsection
