@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.list') }} {{ __('avored::system.terms.order') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.list') }} {{ __('avored::system.terms.order') }}
        </div>
    </div>
@endsection

@section('content')
{{-- <order-table
    :init-orders="{{ json_encode($orders) }}"
    :order-statuses="{{ json_encode($orderStatuses) }}"
    filter-url="{{ route('admin.order.filter') }}"
    base-url="{{ asset(config('avored.admin_url')) }}"
></order-table> --}}


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
                        x-on:change="filterData('{{ route('admin.order.index') }}', $event)"
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
                                <input id="checkbox-column-shipping-option" 
                                    x-bind:checked="columns.shipping_option"
                                    x-on:click="toggleHiddenColumn('shipping_option')" 
                                    type="checkbox" />
                                <label for="checkbox-column-shipping-option" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.shipping_option') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-payment-option" 
                                    x-bind:checked="columns.payment_option"
                                    x-on:click="toggleHiddenColumn('payment_option')" 
                                    type="checkbox" />
                                <label for="checkbox-column-payment-option" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.payment_option') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input id="checkbox-column-customer" 
                                    x-bind:checked="columns.customer"
                                    x-on:click="toggleHiddenColumn('customer')" 
                                    type="checkbox" />
                                <label for="checkbox-column-customer" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.customer') }}
                                </label>
                            </li>
                            <li class="z-50 py-2">
                                <input 
                                    x-bind:checked="columns.order_status"
                                    x-on:click="toggleHiddenColumn('order_status')" 
                                    id="checkbox-column-order-status" type="checkbox" />
                                <label for="checkbox-column-order-status" 
                                    class="ml-3 text-xs">
                                    {{ __('avored::system.order_status') }}
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
                    <th x-show="columns.shipping_option" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.shipping_option') }}
                    </th>
                    <th x-show="columns.payment_option" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.payment_option') }}
                    </th>
                    <th x-show="columns.customer" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.customer') }}
                    </th>
                    <th x-show="columns.order_status" class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.order_status') }}
                    </th>
                    <th class="px-6 py-3 border-b text-left border-gray-200 text-xs font-medium uppercase">
                        {{ __('avored::system.actions') }}
                    </th>
                    
                </tr>
            </thead>
            <tbody class="bg-white">
               
                @foreach ($orders as $order)
                    <tr>
                        <td x-show="columns.id"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $order->id }}
                        </td>
                        <td x-show="columns.shipping_option"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $order->shipping_option }}
                        </td>
                        <td x-show="columns.payment_option"  class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $order->payment_option }}
                           
                        </td>
                       
                        <td 
                            x-show="columns.customer" 
                            class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $order->customer->first_name . ' ' . $order->customer->last_name  ?? ''}}
                        </td>
                        <td x-show="columns.order_status" 
                            class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            {{ $order->orderStatus->name ?? ''}}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 border-b border-gray-200">
                            
                            <div x-data="{ isVisible: false }" class="ml-auto flex items-center mr-3">
                                <div class="relative inset-0" x-on:click="isVisible = false">
                                    <div class="relative inline-block" 
                                        x-on:mouseover="isVisible = true" 
                                        x-on:mouseleave="isVisible = false" 
                                        x-on:keydown.enter="isVisible = !isVisible">
                                        <button 
                                            type="button" 
                                            class="inline-flex items-center justify-between px-2 py-1 font-medium text-gray-700 transition-all duration-500 rounded-md focus:outline-none focus:text-brand-900 sm:focus:shadow-outline">
                                            <span class="flex-shrink-0">
                                                {{ __('avored::system.actions') }}
                                            </span>
                                            <svg fill="currentColor" viewBox="0 0 20 20" class="flex-shrink-0 w-5 h-5 ml-1">
                                                <path
                                                    :class="{ 'rotate-180': isVisible }"
                                                    class="transition duration-300 ease-in-out origin-center transform"
                                                    fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd">
                                                </path>
                                            </svg>
                                        </button>
                                        
                                        <div x-show.transition="isVisible" class="absolute w-40 right-0  bg-gray-300 z-30 py-3">
                                            <div class="relative my-2 bg-gray-300">
                                                <a href="{{ route('admin.order.show', $order) }}"
                                                    class="px-3 block hover:text-gray-500 text-primary">
                                                    {{ __('avored::system.show') }}
                                                </a>
                                                <a href="#" class="px-3 block mt-3 hover:text-gray-500 text-primary"
                                                    x-on:click.prevent="alert('todo'); return ;changeStatusMenuClick(item, $event)">
                                                    {{ __('avored::system.change_status') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- 
                            <span class="mx-2">|</span>
                            <a href="{{ route('admin.category.destroy', $category) }}"
                                class="text-primary"
                                onclick="event.preventDefault();
                                    document.getElementById('admin-category-{{ $category->id }}-delete').submit();">
                                {{ __('avored::system.delete') }}
                            </a>
                            <form id="admin-category-{{ $category->id }}-delete" 
                                action="{{ route('admin.category.destroy', $category) }}" 
                                method="POST" style="display: none;">
                                @csrf
                                @method('delete')
                            </form>
                            --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="block mt-5 w-full">
        {{ $orders->render('avored::partials.paginate') }}
    </div>
</div>
@endsection



@push('bottom-scripts')
<script>
    function avoredTable(filterText = '') {
        return {
            columns: {
                id: true,
                shipping_option: true,
                payment_option: true,
                order_status: true,
                customer: true,
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
