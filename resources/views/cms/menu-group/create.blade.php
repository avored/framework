@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.create') }} {{ __('avored::system.menu-group') }}: AvoRed E commerce Admin Dashboard
@endsection


@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.create') }} {{ __('avored::system.menu-group') }}
        </div>
    </div>
@endsection

@section('content')
<div class="block w-full">
    <div class="menu-save-page">
        <form method="post" action="{{ route('admin.menu-group.store') }}">
            @csrf
               
            <div class="flex mt-3 w-full">
                @include('avored::system.form.input', [
                    'name' => 'name',
                    'label' => __('avored::system.name'),
                    'value' => ''
                ])
            </div>
            <div class="flex mt-3 w-full">
                @include('avored::system.form.input', [
                    'name' => 'identifier',
                    'label' => __('avored::system.identifier'),
                    'value' => ''
                ])
            </div>
           
            
            <div class="mt-3 py-3">
                @include('avored::partials.forms.action-buttons', ['url' => route('admin.menu-group.index')])
            </div>
        </form>
    </div> 
</div>
@endsection
