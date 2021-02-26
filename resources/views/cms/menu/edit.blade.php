@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.pages.title.edit', ['attribute' => __('avored::system.terms.menu')]) }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.pages.title.edit', ['attribute' => __('avored::system.terms.menu')]) }}
        </div>
    </div>
@endsection

@section('content')
<div class="block">
    <menu-save inline-template>
        <form method="post" action="{{ route('admin.menu.update', ['menuGroup' => $menuGroup->id, 'menu' => $menu]) }}">
            @csrf
            @method('put')
            @include('avored::cms.menu._fields')

            <div class="mt-3 py-3">
                @include('avored::partials.forms.action-buttons', ['url' => route('admin.menu-group.edit', ['menu_group' => $menuGroup->id])])
            </div>
        </form>
    </menu-save>
</div>
@endsection
