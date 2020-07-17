<div class="bg-white border-r min-h-screen"> 
    <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center mt-2">
            <img class="h-12 block ml-6 w-12" src="{{ asset('vendor/avored/images/logo_only.svg') }}" />
            <div class="text-xl text-red-600" :class="sidebar ? 'hidden' : ''">AvoRed</div>
        </a>
    </div>

    <nav class="mt-10">
        @foreach ($adminMenus as $key => $adminMenu)
            <avored-menu :sidebar="sidebar" :menu="{{ json_encode($adminMenu) }}"></avored-menu>
        @endforeach

        {{-- <div class="relative menu-item">
            <button class="w-full menu-item flex justify-between items-center py-3 px-6 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                <span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" icon="store-front" class="menu-icon fill-current h-4 w-4">
                        <path d="M18 9.87V20H2V9.87a4.25 4.25 0 0 0 3-.38V14h10V9.5a4.26 4.26 0 0 0 3 .37zM3 0h4l-.67 6.03A3.43 3.43 0 0 1 3 9C1.34 9 .42 7.73.95 6.15L3 0zm5 0h4l.7 6.3c.17 1.5-.91 2.7-2.42 2.7h-.56A2.38 2.38 0 0 1 7.3 6.3L8 0zm5 0h4l2.05 6.15C19.58 7.73 18.65 9 17 9a3.42 3.42 0 0 1-3.33-2.97L13 0z"></path>
                    </svg>
                    <span class="ml-6 font-medium">Catalog</span>
                </span>
                <span>
                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4">
                        <!----> 
                        <path d="M19 9L12 16L5 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </button>
            <div class="absolute sub-menu">
                <div class="bg-gray-100"><a href="https://laravel-ecommerce.test/admin/product" class="py-2 cursor-pointer pl-16 pr-3 block text-sm text-gray-600 hover:bg-red-500 hover:text-white">
                    Product
                    </a>
                </div>
                <div class="bg-gray-100"><a href="https://laravel-ecommerce.test/admin/category" class="py-2 cursor-pointer pl-16 pr-3 block text-sm text-gray-600 hover:bg-red-500 hover:text-white">
                    Category
                    </a>
                </div>
                <div class="bg-gray-100"><a href="https://laravel-ecommerce.test/admin/property" class="py-2 cursor-pointer pl-16 pr-3 block text-sm text-gray-600 hover:bg-red-500 hover:text-white">
                    Product Property
                    </a>
                </div>
                <div class="bg-gray-100"><a href="https://laravel-ecommerce.test/admin/attribute" class="py-2 cursor-pointer pl-16 pr-3 block text-sm text-gray-600 hover:bg-red-500 hover:text-white">
                    Attribute
                    </a>
                </div>
            </div>
        </div> --}}


    </nav>

</div>
