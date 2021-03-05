@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.admin-user') }} {{ __('avored::system.list') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.admin-user') }} {{ __('avored::system.list') }}
        </div>
    </div>
@endsection


@section('content')
<div class="block w-full" x-data="avoredTable('{{ request()->get('filter', '') }}')">
    <div class="flex mb-3 w-full">
        <div class="ml-auto">
            <div x-on:click.away="filterBtnClicked=false" class="mb-2 relative flex sm:flex-row flex-col">
                <div class="block relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input placeholder="Search"
                        x-model="filterText"
                        x-on:change="filterData('{{ route('admin.admin-user.index') }}', $event)"
                        class="appearance-none rounded-l border-2 border-gray-400 block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </div>
                <div class="flex flex-row mb-1 sm:mb-0">
                    <button
                        x-on:click="filterBtnClicked = !filterBtnClicked"  type="button" 
                        class="px-2 border-none rounded-r active:outline-none flex py-2 bg-gray-400">
                        <svg class="h-6 pt-1 w-6 text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 12l8-8V0H0v4l8 8v8l4-4v-4z"  fill-rule="evenodd"/>
                        </svg>
                        <span class="ml-1 text-gray-700">
                            {{ __('avored::system.filter') }}
                        </span>
                    </button>
                </div>
                <div x-show="filterBtnClicked" class="absolute z-10 right-0" style="top:100%">
                    <div class="border-3 rounded-b text-white p-3 w-auto bg-gray-500 border-gray-800" style="top:100%;min-width: 10rem;">
                        <ul>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-id" 
                                    x-bind:checked="columns.id"
                                    x-on:click="toggleHiddenColumn('id')" 
                                    type="checkbox" />
                                <label for="checkbox-column-id" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.id') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-first-name" 
                                    x-bind:checked="columns.first_name"
                                    x-on:click="toggleHiddenColumn('first_name')" 
                                    type="checkbox" />
                                <label for="checkbox-column-first-name" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.first_name') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-last-name" 
                                    x-bind:checked="columns.last-name"
                                    x-on:click="toggleHiddenColumn('last_name')" 
                                    type="checkbox" />
                                <label for="checkbox-column-last-name" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.last_name') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-email" 
                                    x-bind:checked="columns.email"
                                    x-on:click="toggleHiddenColumn('email')" 
                                    type="checkbox" />
                                <label for="checkbox-column-email" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.email') }}
                                </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shadow w-full rounded">
        <table class="min-w-full">
            <thead class="bg-gray-700 text-white">
                <tr>
                    <th x-show="columns.id" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.id') }}
                    </th>
                    <th x-show="columns.first_name" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.first_name') }}
                    </th>
                    <th x-show="columns.last_name" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.last_name') }}
                    </th>
                    <th x-show="columns.email" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.email') }}
                    </th>
                    <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.actions') }}
                    </th>
                    
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($adminUsers as $adminUser)
                    <tr>
                        <td x-show="columns.id"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $adminUser->id }}
                        </td>
                        <td x-show="columns.first_name"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            <a href="{{ route('admin.admin-user.edit', $adminUser) }}"
                                class="text-primary">
                                {{ $adminUser->first_name }}
                            </a>
                        </td>
                        <td x-show="columns.last_name"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            <a href="{{ route('admin.admin-user.edit', $adminUser) }}"
                                class="text-primary">
                                {{ $adminUser->last_name }}
                            </a>
                        </td>
                        <td x-show="columns.email" 
                            class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $adminUser->email }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            <a href="{{ route('admin.admin-user.edit', $adminUser) }}"
                                class="text-primary">
                                {{ __('avored::system.edit') }}
                            </a>
                            <span class="mx-2">|</span>
                            <a href="{{ route('admin.admin-user.destroy', $adminUser) }}"
                                class="text-primary"
                                onclick="event.preventDefault();
                                    document.getElementById('admin-admin-user-{{ $adminUser->id }}-delete').submit();">
                                {{ __('avored::system.delete') }}
                            </a>
                            <form id="admin-admin-user-{{ $adminUser->id }}-delete" 
                                action="{{ route('admin.admin-user.destroy', $adminUser) }}" 
                                method="POST" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="block mt-5 w-full">
        {{ $adminUsers->render('avored::partials.paginate') }}
    </div>
</div>
@endsection


@push('bottom-scripts')
<script>
    function avoredTable(filterText = '') {
        return {
            columns: {
                id: true,
                first_name: true,
                last_name: true,
                email: true,
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
