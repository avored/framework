@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.category') }} {{ __('avored::system.list') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.category') }} {{ __('avored::system.list') }}
        </div>
        <div class="ml-auto">
            <a href="{{ route('admin.category.create') }}"
                class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
            >
                <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                </svg>
                {{ __('avored::system.create') }}
            </a>
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
                        x-on:change="filterData('{{ route('admin.category.index') }}', $event)"
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
                                <input id="checkbox-column-parent-id" 
                                    x-bind:checked="columns.parent_id"
                                    x-on:click="toggleHiddenColumn('parent_id')" 
                                    type="checkbox" />
                                <label for="checkbox-column-parent-id" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.parent-id') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-name" 
                                    x-bind:checked="columns.name"
                                    x-on:click="toggleHiddenColumn('name')" 
                                    type="checkbox" />
                                <label for="checkbox-column-name" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.name') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-slug" 
                                    x-bind:checked="columns.slug"
                                    x-on:click="toggleHiddenColumn('slug')" 
                                    type="checkbox" />
                                <label for="checkbox-column-slug" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.slug') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input 
                                    x-bind:checked="columns.meta_title"
                                    x-on:click="toggleHiddenColumn('meta_title')" 
                                    id="checkbox-column-meta-title" type="checkbox" />
                                <label for="checkbox-column-meta-title" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.meta_title') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input 
                                    id="checkbox-column-meta-description" 
                                    x-bind:checked="columns.meta_description"
                                    x-on:click="toggleHiddenColumn('meta_description')" 
                                    type="checkbox" />
                                <label for="checkbox-column-meta-description" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.meta_description') }}
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
                    <th x-show="columns.parent_id" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.parent-id') }}
                    </th>
                    <th x-show="columns.name" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.name') }}
                    </th>
                    <th x-show="columns.slug" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.slug') }}
                    </th>
                    <th x-show="columns.meta_title" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.meta_title') }}
                    </th>
                    <th x-show="columns.meta_description" 
                        class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.meta_description') }}
                    </th>
                    <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.actions') }}
                    </th>
                    
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($categories as $category)
                    <tr>
                        <td x-show="columns.id"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $category->id }}
                        </td>
                        <td x-show="columns.parent_id"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $category->parent->name ?? '' }}
                        </td>
                        <td x-show="columns.name"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            <a href="{{ route('admin.category.edit', $category) }}"
                                class="text-primary">
                                {{ $category->name }}
                            </a>
                        </td>
                        <td x-show="columns.slug" 
                            class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $category->slug }}
                        </td>
                        <td x-show="columns.meta_title" 
                            class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $category->meta_title }}
                        </td>
                        <td 
                            x-show="columns.meta_description" 
                            class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $category->meta_description }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            <a href="{{ route('admin.category.edit', $category) }}"
                                class="text-primary">
                                {{ __('avored::system.edit') }}
                            </a>
                            <span class="mx-2">|</span>
                            <a href="{{ route('admin.category.destroy', $category) }}"
                                class="text-primary"
                                x-on:click.prevent="deleteOnClick('{{ json_encode($category) }}')"
                                >
                                {{ __('avored::system.delete') }}
                            </a>
                            <form id="admin-category-{{ $category->id }}-delete" 
                                action="{{ route('admin.category.destroy', $category) }}" 
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
        {{ $categories->render('avored::partials.paginate') }}
    </div>
    <div
        x-show="confirmationModel"
        x-on:keydown.escape.window="confirmationModel = false"
        class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center">

        <div    
            x-show="confirmationModel"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <div
            x-show="confirmationModel"
            x-on:click.away="confconfirmationModel = false"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full" 
                role="dialog"
                aria-modal="true" 
                aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            {{ __('avored::system.delete') }} 
                            <span x-text="modelResource.name + ' #' + modelResource.id"></span>
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-500">
                                {{ __('avored::system.delete_confirmation_message', ['attribute' => strtolower(__('avored::system.category'))]) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                    <button @click="approveConfirmation" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        {{ __('avored::system.delete') }}
                    </button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button @click="confirmationModel = false" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        {{ __('avored::system.cancel') }}
                    </button>
                </span>
            </div>
        </div>
    </div>

</div>
@endsection


@push('bottom-scripts')
<script>
    function avoredTable(filterText = '') {
        return {
            confirmationModel: false,
            modelResource: {},
            columns: {
                id: true,
                parent_id: true,
                name: true,
                slug: true,
                meta_title: true,
                meta_description : false,
            },
            filterText: filterText,
            filterBtnClicked: false,
            toggleHiddenColumn(name) {
                this.columns[name] = !this.columns[name]
            },
            deleteOnClick(model) {
                this.modelResource = JSON.parse(model)
                this.confirmationModel = true
            },
            approveConfirmation() {
                document.getElementById(`admin-category-${this.modelResource.id}-delete`).submit();
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
