<x-avored::layout>
<div>
    <div class="p-5">
        <div class="flex w-full">
            <h2 class="text-2xl text-red-700 font-semibold">
                {{ __('avored::system.order') }} {{ __('avored::system.list') }}
            </h2>
           
        </div>

        <div class="w-full mt-5">
            <!-- component -->
            <div class="overflow-x-auto">
                <x-avored::table>
                    <x-slot name="header">
                        <x-avored::table.row class="bg-gray-300">

                            <x-avored::table.header>
                                {{ __('avored::system.shipping_option') }}
                            </x-avored::table.header>
                            <x-avored::table.header>
                                {{ __('avored::system.payment_option') }}
                            </x-avored::table.header>
                            

                            <x-avored::table.header class="rounded-tr">
                                {{ __('avored::system.actions') }}
                            </x-avored::table.header>
                        </x-avored::table.row>
                    </x-slot>
                    <x-slot name="body">
                        @foreach ($orders as $order)
                            <x-avored::table.row class="{{ ($loop->index % 2 == 0) ? '' : 'bg-gray-200'  }}">
                                <x-avored::table.cell>
                                    {{ $order->shipping_option ?? '' }}
                                </x-avored::table.cell>
                               
                                <x-avored::table.cell>
                                    {{ $order->payment_option ?? '' }}
                                </x-avored::table.cell>
                               

                                <x-avored::table.cell>
                                    <div class="flex">
                                        <x-avored::link url="{{ route('admin.order.show', $order) }}">
                                            <i class="w-5 h-5" data-feather="eye"></i>
                                        </x-avored::link>
                                        
                                    </div>
                                </x-avored::table.cell>
                            </x-avored::table.row>
                        @endforeach
                    </x-slot>
                </x-avored::table>
                <div class="w-full">
                    {{ $orders->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-avored::layout>
