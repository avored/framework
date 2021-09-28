<div class="lg:static bg-red-500 min-h-screen bottom-0 sm:w-16 text-white h-full "
    :class="isSideBarOpen ? 'lg:w-64 z-10' : 'lg:w-16'"
    x-transition.duration.300ms>
    <div class="bg-white text-red-700 h-16 p-2 flex items-center shadow">
        <img class="h-8 w-8 ml-4" src="{{ asset('/vendor/avored/images/logo_only.svg') }}" alt="AvoRed Ecommerce" />
        <span class="font-bold ml-2">AvoRed</span>
    </div>

    <div class="space-x-8 p-2 overflow-hidden">
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2">
            @foreach ($adminMenus as $adminMenu)
                <div x-data="{ isActive: false, open: false}" class="space-x-2">
                    <a href="#" x-on:click="$event.preventDefault(); open = !open"
                        class="flex items-center my-5 ml-3 pr-2 text-white transition-colors rounded-md"
                        role="button" aria-haspopup="true"
                        :aria-expanded="(open || isActive) ? 'true' : 'false'">
                        <span aria-hidden="true">
                            <i class="h-5 w-5" data-feather="{{ $adminMenu->icon() }}"></i>
                        </span>
                        <span class="ml-3 text-sm">{{ $adminMenu->label() }}</span>
                        <span class="ml-auto" aria-hidden="true">
                            <!-- active class 'rotate-180' -->
                            <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </a>
                    <div role="menu" x-show="open" class="mt-2 ml-2 space-y-2 px-8" aria-label="{{ $adminMenu->label() }}">
                        @foreach ($adminMenu->subMenu as $subMenu)
                            <a href="{{ route($subMenu->route(), $subMenu->params()) }}" role="menuitem"
                                class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                                {{ $subMenu->label() }}
                            </a>
                        @endforeach

                    </div>
                </div>
            @endforeach
        </nav>
    </div>
</div>
