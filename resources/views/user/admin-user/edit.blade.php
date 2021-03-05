@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.edit', ['attribute' => __('avored::system.terms.admin_user')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.edit', ['attribute' => __('avored::system.terms.admin_user')]) }}
        </div> 
    </div>
@endsection

@section('content')
<div class="flex items-center">
    <admin-user-save base-url="{{ asset(config('avored.admin_url')) }}" :admin-user="{{ $adminUser }}" inline-template>
        <div class="w-full block">
            <form method="post" action="{{ route('admin.admin-user.update', $adminUser->id) }}">
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
                    @include('avored::partials.forms.action-buttons', ['url' => route('admin.admin-user.index')])
                </div>
                
            </form>
        </div>
    </admin-user-save>
</div>
@endsection
