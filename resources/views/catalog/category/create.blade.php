<x-avored::layout>
    <div>
        <div class="p-5">
            <div class="flex w-full">
                <h2 class="text-2xl text-red-700 font-semibold">
                    {{ __('avored::system.create') }} {{ __('avored::system.category') }}
                </h2>

            </div>

            <div class="mt-5 w-full">
                <x-avored::form.form action="{{ route('admin.category.store') }}" method="POST">

                    <ul class="flex justify-center items-center my-4">
                        @foreach ($tabs as $tab)
                            <li class="cursor-pointer py-2 px-4 text-gray-500 border-b-8"
                                :class="activeTab=='{{ $tab->key() }}' ? 'text-red-500 border-red-500' : ''"
                                x-on:click="activateTab('{{ $tab->key() }}')"
                            >{{ $tab->label() }}</li>

                        @endforeach
                    </ul>

                        <div class="w-full bg-white p-16 text-center mx-auto border">
                            @foreach ($tabs as $tab)
                                <div x-show="activeTab=='{{ $tab->key() }}'">
                                    @php
                                        $path = $tab->view();
                                    @endphp
                                    @include($path)
                                </div>
                            @endforeach

                        </div>



                    <div class="mt-6 flex">
                        <button type="submit"
                            class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700">

                            {{ __('avored::system.create') }}
                        </button>

                        <x-avored::link url="{{ route('admin.category.index') }}" class="ml-3" style="button-default">
                            Cancel
                        </x-avored::link>
                    </div>
                </x-avored::form.form>
            </div>
        </div>

    </div>

</x-avored::layout>
