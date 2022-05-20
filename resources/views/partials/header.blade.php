<div class="flex w-full p-3 h-16 shadow lg:space-x-10 bg-white">
    <div class="flex items-center w-full">

        <div x-on:click="isSideBarOpen = !isSideBarOpen" class="text-red-700 ml-3 cursor-pointer">
            <svg  xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        <div class="ml-auto">
            <div x-data="{ dropdownOpen: false }" class="ml-auto relative">
                <div x-on:click="dropdownOpen = !dropdownOpen" class="relative flex items-center cursor-pointer">

                    <img src="{{ Auth::guard('admin')->user()->image_path_url }}"
                        class="h-8 w-8 rounded-full"
                        alt="{{ Auth::guard('admin')->user()->full_name }}" />
                    <span class="text-red-600 ml-1 text-sm font-bold">{{ Auth::guard('admin')->user()->full_name }}</span>

                    <svg class="h-5 w-5 text-red-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>

                </div>

                <div x-show="dropdownOpen" x-on:click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                <div x-show="dropdownOpen" x-transition.duration.300ms class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                    <a href="{{ route('admin.dashboard', auth()->guard('admin')->user()) }}" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-red-500 rounded hover:text-white">
                        {{ __('avored::system.edit_profile') }}
                    </a>

                    <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-red-500 rounded hover:text-white">
                        Settings
                    </a>
                    <a href="#" class="block px-4 py-2 text-sm capitalize text-gray-700 hover:bg-red-500 rounded hover:text-white">
                        {{ __('avored::system.logout') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
