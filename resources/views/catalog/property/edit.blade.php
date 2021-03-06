@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.edit') . ' ' . __('avored::system.property') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.edit') . ' ' . __('avored::system.property') }}
        </div>
       
    </div>
@endsection

@section('content')
<div class="block w-full items-center">
    <form method="post" action="{{ route('admin.property.update', $property->id) }}">
        @csrf
        @method('put')
        
        @include('avored::system.form.tabs')
        
        <div class="mt-3 py-3">
            @include('avored::partials.forms.action-buttons', ['url' => route('admin.property.index')])
        </div>
    </form>
</div>
@endsection
