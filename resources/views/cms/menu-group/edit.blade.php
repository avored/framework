@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.edit') }} {{ __('avored::system.menu-group') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.edit') }} {{ __('avored::system.menu-group') }}
        </div>
    </div>
@endsection

@section('content')
<div class="flex items-center">
    <div class="w-full menu-save-page block">
        <form method="post" action="{{ route('admin.menu-group.update', $menuGroup->id) }}">
            @csrf
            @method('put')
            @include('avored::cms.menu-group._fields')

            <div class="mt-3 py-3">
                @include('avored::partials.forms.action-buttons', ['url' => route('admin.menu-group.index')])
            </div>
        </form>
    </div>
   
</div>
@endsection

@push('bottom-scripts')

<script>
    function avoredTable(filterText = '') {
        return {
            columns: {
                id: true,
                name: true,
                type: true,
                sort_order: true,
                
            },
            filterText: filterText,
            filterBtnClicked: false,
            toggleHiddenColumn(name) {
                this.columns[name] = !this.columns[name]
            },
            filterData(url, e) {
                this.filterText = e.target.value
                const params = new URLSearchParams({
                    filter: e.target.value
                })
                
                location.href = url + '?' + params.toString()
            }
        }
    }
</script>
@endpush
