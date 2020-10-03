@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::system.new_customers') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{ __('avored::system.new_customers') }}
        </div>
    </div>
@endsection

@section('content')
<div class="">
    <div class="w-full block">
        <form 
            method="post"
            action="{{ route('admin.report.post', ['identifier' => 'new-customer']) }}">
                @csrf
            <div class="flex">
                <div class="w-1/2">
                    <avored-input
                        label-text="{{ __('avored::system.fields.from') }}"
                        field-name="from"
                        input-type="date"
                        init-value="{{ session('report_new_customer')['from'] ?? '' }}"
                        error-text="{{ $errors->first('from') }}"
                    >
                    </avored-input>
                </div>
                <div class="w-1/2 ml-3">
                    <avored-input
                        label-text="{{ __('avored::system.fields.to') }}"
                        field-name="to"
                        input-type="date"
                        init-value="{{ session('report_new_customer')['to'] ?? '' }}"
                        error-text="{{ $errors->first('to') }}"
                    >
                    </avored-input>
                </div>
            </div>
            <div class="mt-3">
                <avored-select
                    label-text="{{ __('avored::system.fields.group_by') }}"
                    field-name="group_by"
                    init-value="{{ session('report_new_customer')['group_by'] ?? '' }}"
                    :options="{{ json_encode($timePeriodOptions) }}"
                ></avored-select>
            </div>
            <div class="mt-3 py-3">
                <button type="submit"
                    class="px-6 py-3 font-semibold leading-7  text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                >   
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 inline-flex w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/>
                    </svg>
                    <span class="ml-3">{{ __('avored::system.btn.save') }}</span>
                </button>
                
                <a href="{{ route('admin.admin-user.index') }}"
                    class="px-6 py-3 font-semibold inline-block text-white leading-7 hover:text-white bg-gray-500 rounded hover:bg-gray-600">
                    <span class="leading-7">
                        {{ __('avored::system.btn.cancel') }}
                    </span>
                </a>
            </div>
        </form>
    </div>

    @if ($displayReport)
    <div class="w-full mt-5 block">
        <h1 class="mt-3 text-red-700 text-2xl">
            {{ __('avored::system.chart_label', ['attribute' => __('avored::system.new_customers')]) }}
        </h1>
        <div class="block">
            <avored-new-customer-report  :customers="{{ json_encode($customers) }}" />
        </div>

        <h1 class="mt-5 text-red-700 text-2xl">
            {{ __('avored::system.table_label', ['attribute' => __('avored::system.new_customers')]) }}
        </h1>
        <table class="mt-5 border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
            <thead>
                <tr class="text-left">
                    
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                        {{ __('avored::system.new_customer_label') }}
                    </th>
                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-2 text-gray-600 font-bold tracking-wider uppercase text-xs">
                        {{ __('avored::system.total_new_customers') }}
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $key => $customer)
                    <tr>
                        <td class="border-dashed border-t border-gray-200 userId">
                            <span class="text-gray-700 px-6 py-3 flex items-center" >{{ $key }}</span>
                        </td>
                        <td class="border-dashed border-t border-gray-200 firstName">
                            <span class="text-gray-700 px-6 py-3 flex items-center">
                                {{ $customer->count() }}
                            </span>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
