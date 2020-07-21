<div class="bg-white z-1 shadow p-0">
        <div class="flex px-3 py-2 h-16 items-center">
            <div class="mr-auto ml-3 cursor-pointer">
                <svg 
                    xmlns="http://www.w3.org/2000/svg" 
                    class="w-5 h-5"
                    @click="sidebar = !sidebar"
                ><path d="M1 1h18v2H1V1zm6 8h12v2H7V9zm-6 8h18v2H1v-2zM7 5h12v2H7V5zm0 8h12v2H7v-2zM1 6l4 4-4 4V6z"/>
                </svg>
            </div>
            
            <div class="ml-auto flex items-center mr-3">
                <div class="relative inset-0" @click="isVisible = false">
                    <div class="relative inline-block" @mouseover="isVisible = true" @mouseleave="isVisible = false" @keydown.enter="isVisible = !isVisible">
                        <button type="button" class="inline-flex items-center justify-between px-2 py-1 font-medium text-gray-700 transition-all duration-500 rounded-md focus:outline-none focus:text-brand-900 sm:focus:shadow-outline">
                        <span class="flex-shrink-0">
                            {{ Auth::guard('admin')->user()->full_name }}
                        </span>
                        <svg fill="currentColor" viewBox="0 0 20 20" class="flex-shrink-0 w-5 h-5 ml-1">
                            <path :class="{ 'rotate-180': isVisible }" class="transition duration-300 ease-in-out origin-center transform" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        </button>
                        <transition enter-active-class="transition duration-300 ease-out transform" enter-class="-translate-y-3 scale-95 opacity-0" enter-to-class="translate-y-0 scale-100 opacity-100" leave-active-class="transition duration-150 ease-in transform" leave-class="translate-y-0 opacity-100" leave-to-class="-translate-y-3 opacity-0">
                            <div v-show="isVisible" class="absolute w-full pt-2">
                                <div class="relative mt-2 py-3 bg-white border border-gray-200">
                                    <a href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('admin-logout-form').submit();"
                                        class="w-full py-4 px-4 font-medium text-gray-700 hover:bg-gray-100 focus:outline-none hover:text-gray-900 focus:text-gray-900 focus:shadow-outline transition duration-300 ease-in-out">
                                    {{ __('avored::system.header.logout') }}
                                    </a>
                                    <form id="admin-logout-form" 
                                        action="{{ route('admin.logout') }}" 
                                        method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
        
</div>
