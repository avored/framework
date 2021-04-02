@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.edit') . ' ' . __('avored::system.attribute') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.edit') . ' ' . __('avored::system.attribute') }}
        </div>
       
    </div>
@endsection

@section('content')
<div class="block w-full items-center">
    <form method="post" action="{{ route('admin.attribute.update', $attribute->id) }}">
        @csrf
        @method('put')
        
        @include('avored::system.form.tabs')
        
        <div class="mt-3 py-3">
            @include('avored::partials.forms.action-buttons', ['url' => route('admin.attribute.index')])
        </div>
    </form>
</div>
@endsection
