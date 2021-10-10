<x-avored::layout>
    <div>
        <div class="p-5">
            <div class="flex w-full">
                <h2 class="text-2xl text-red-700 font-semibold">
                    {{ __('avored::system.create') }} {{ __('avored::system.category') }}
                </h2>

            </div>

            <div class="mt-5 w-full">
                <x-avored::form.form action="{{ route('admin.product.store') }}" method="POST">

                    <div class="w-full border rounded">
                        <div class="p-4 border-b">
                            <div class="flex w-full">
                                <span class="text-lg text-red-500 font-semibold">
                                    {{ __('avored::system.basic_info') }}
                                </span>
                                <span class="ml-auto">

                                </span>
                            </div>

                        </div>
                        <div class="p-4">
                            <div class="flex w-full">
                                <div class="w-1/2">
                                    <div class="mt-3">
                                        <x-avored::form.input
                                            name="name"
                                            label="{{ __('avored::system.name') }}"
                                        ></x-avored::form.input>
                                    </div>
                                </div>
                                <div class="ml-3 w-1/2">
                                    <div class="mt-3">
                                        <x-avored::form.input
                                            name="slug"
                                            label="{{ __('avored::system.slug') }}"
                                        ></x-avored::form.input>
                                    </div>
                                </div>
                            </div>

                            <div class="flex w-full">
                                <div class="mt-3 w-full">
                                    <x-avored::form.select
                                        name="type"
                                        autofocus
                                        label="{{ __('avored::system.type') }}"
                                    >

                                        <option value="">{{ __('avored::system.please_select') }}</option>
                                        @foreach ($typeOptions as $typeValue => $typeLabel)
                                            <option value="{{ $typeValue }}">
                                                {{ $typeLabel }}
                                            </option>
                                        @endforeach

                                    </x-avored::form.select>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex">
                        <button type="submit"
                            class="flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700">

                            {{ __('avored::system.create') }}
                        </button>

                        <x-avored::link url="{{ route('admin.product.index') }}" class="ml-3" style="button-default">
                            Cancel
                        </x-avored::link>
                    </div>
                </x-avored::form.form>
            </div>
        </div>

    </div>

</x-avored::layout>
