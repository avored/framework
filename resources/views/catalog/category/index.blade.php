<x-avored::layout>
<div  x-data="avoredConfirmationDialog()">
    <div class="p-5">
        <div class="flex w-full">
            <h2 class="text-2xl text-red-700 font-semibold">
                {{ __('avored::system.category') }} {{ __('avored::system.list') }}
            </h2>
            <span class="ml-auto">
                <x-avored::link url="{{ route('admin.category.create') }}" style="button">
                    {{ __('avored::system.create') }}
                </x-avored::link>
            </span>
        </div>

        <div class="w-full mt-5">
            <!-- component -->
            <div class="overflow-x-auto">
                <div
                    class="flex overflow-hidden">
                    <div class="w-full">
                        <div class="bg-white shadow-md rounded my-6">
                            <table class="min-w-max w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="rounded-tl py-3 px-6 text-left">
                                            <x-avored::form.checkbox onclick="alert('here')" />
                                        </th>
                                        <th class="rounded-tl py-3 px-6 text-left">
                                            {{ __('avored::system.parent') }}
                                        </th>
                                        <th class="rounded-tl py-3 px-6 text-left">
                                            {{ __('avored::system.name') }}
                                        </th>
                                        <th class="py-3 px-6 text-left">
                                            {{ __('avored::system.slug') }}
                                        </th>
                                        <th class="py-3 px-6 text-left">
                                            {{ __('avored::system.meta_title') }}
                                        </th>
                                        <th class="py-3 px-6 text-left ">
                                            {{ __('avored::system.meta_description') }}

                                        </th>
                                        <th class="rounded-tr py-3 px-6 text-left">
                                            {{ __('avored::system.actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach ($categories as $category)
                                        <tr class="border-b border-gray-200  hover:bg-gray-100">
                                            <th class="rounded-tl py-3 px-6 text-left">
                                                <x-avored::form.checkbox />
                                            </th>
                                            <td class="py-3 px-6 whitespace-nowrap">
                                                {{ $category->parent->name ?? '' }}
                                            </td>
                                            <td class="py-3 px-6 whitespace-nowrap">
                                                {{ $category->name }}
                                            </td>
                                            <td class="py-3 px-6 whitespace-nowrap">
                                                {{ $category->slug }}
                                            </td>
                                            <td class="py-3 px-6 whitespace-nowrap">
                                                {{ $category->meta_title }}
                                            </td>
                                            <td class="py-3 px-6 whitespace-nowrap">
                                                {{ $category->meta_description }}
                                            </td>
                                            <td class="py-3 px-6 whitespace-nowrap">
                                                <div class="flex">
                                                    
                                                    <x-avored::link url="{{ route('admin.category.edit', $category) }}">
                                                        <i class="w-5 h-5" data-feather="edit"></i>
                                                    </x-avored::link>
                                                    <span class="mx-2">|</span>
                                                    <x-avored::link 
                                                        x-data="{}" 
                                                        x-on:click.prevent="toggleConfirmationDialog(true, {{ $category }})" 
                                                        url="{{ route('admin.category.destroy', $category) }}">
                                                        <i class="w-5 h-5" data-feather="trash"></i>
                                                        <x-avored::form.form id="category-destory-{{ $category->id }}" 
                                                            method="delete" 
                                                            action="{{ route('admin.category.destroy', $category) }}">
                                                        
                                                        </x-avored::form.form>
                                                    </x-avored::link>
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    {{ $categories->render() }}
                </div>
            </div>
        </div>
    </div>
    
    <div x-show="showConfirmationModal" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none bg-no-repeat bg-center bg-cover"  
        id="modal-id">
        <div class="absolute bg-black opacity-20 inset-0 z-0"></div>
            <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
            <!--content-->
            <div class="">
                <!--body-->
                <div class="text-center p-5 flex-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-bold py-4 ">
                        Are you sure?
                    </h3>
                    <p class="text-sm text-gray-500 px-8" x-html="message">
                        
                        
                    </p>    
                </div>
                <!--footer-->
                <div class="p-3  mt-2 text-center space-x-4 md:block">
                    <button x-on:click="toggleConfirmationDialog(false)" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100">
                        Cancel
                    </button>
                    <button x-on:click="confirmation" class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:shadow-lg hover:bg-red-600">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function avoredConfirmationDialog() {
        return {
            showConfirmationModal: false,
            message: {},
            toggleConfirmationDialog (val, modal = null) {
                if (modal) {
                    this.modal = modal
                    this.message = 'Do you really want to delete ' + modal.name + ' category \n' + 'This process cannot be undone'
                }
                this.showConfirmationModal = val
            },
            confirmation() {
                console.log(this.modal)
            }
        }
    }
</script>
@endpush
</x-avored::layout>
