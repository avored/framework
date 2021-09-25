<x-avored::layout>
    <div x-data="avoredConfirmationDialog()">
        <div class="p-5">
            <div class="flex w-full">
                <h2 class="text-2xl text-red-700 font-semibold">
                    {{ __('avored::system.create') }} {{ __('avored::system.category') }}
                </h2>

            </div>

            <div class="mt-5 w-full">
                <x-avored::form.form action="{{ route('admin.category.update', $category) }}" method="PUT">
                    @foreach ($tabs as $tab)

                            @php
                                $path = $tab->view();
                            @endphp
                            @include($path)

                    @endforeach

                    <div class="mt-6 flex">
                        <button type="submit"
                            class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700">

                            {{ __('avored::system.save') }}
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
