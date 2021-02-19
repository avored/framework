<div class="bg-white border-r min-h-screen"> 
    <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center mt-2">
            <img class="h-12 block ml-6 w-12" src="{{ asset('vendor/avored/images/logo_only.svg') }}" />
            <div class="text-xl text-red-600" v-bind:class="sidebar ? 'hidden' : ''">AvoRed</div>
        </a>
    </div>

    <nav class="mt-10">
        @foreach ($adminMenus as $key => $adminMenu)
           
            <div x-data="{isVisible:false}" class="relative menu-item">
                <button 
                    x-on:click="isVisible = !isVisible"
                    class="w-full menu-item flex justify-between items-center py-3 px-6 text-gray-600 cursor-pointer
                         hover:bg-gray-100 hover:text-gray-700 focus:outline-none">
                    <span class="flex items-center">
                        <zondicon
                            class="menu-icon fill-current h-4 w-4"
                            icon="{{ Arr::get($adminMenu, 'icon') }}"
                        ></zondicon>
                        <span class="ml-6 menu-label font-medium">
                            {{ __(Arr::get($adminMenu, 'name')) }}
                        </span>
                    </span>

                    <span class="menu-chevron-icon">
                        <svg class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                                <path x-show="!isVisible" d="M9 5L16 12L9 19"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                ></path>
                                <path x-show="isVisible" d="M19 9L12 16L5 9"
                                    stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                ></path>
                        </svg>
                    </span>
                </button>
                @if (count(Arr::get($adminMenu, 'submenus')) > 0)
                    <div x-show="isVisible" v-bind:class="sidebar ? 'sub-menu absolute' : ''">
                        @foreach (Arr::get($adminMenu, 'submenus') as $subMenu)
                                <div v-bind:class="sidebar ? 'bg-white' : ''" x-show="isVisible">
                                    <a class="py-2 cursor-pointer pl-16 pr-3 block text-sm text-gray-600 hover:bg-red-500 hover:text-white"
                                        href="{{ __(Arr::get($subMenu, 'url')) }}">
                                        {{ __(Arr::get($subMenu, 'name')) }}
                                    </a>
                                </div>    
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </nav>

</div>
