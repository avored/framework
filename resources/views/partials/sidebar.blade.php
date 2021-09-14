<div class="fixed lg:static bg-red-500 min-h-screen bottom-0 w-full  text-white lg:h-full "
    :class="isSideBarOpen ? 'lg:w-64 z-10' : 'lg:w-16'"
    x-transition.duration.300ms>
    <div class="bg-white text-red-700 h-16 p-2 flex items-center shadow">
        <img class="h-8 w-8 ml-4" src="{{ asset('/vendor/avored/images/logo_only.svg') }}" alt="AvoRed Ecommerce" />
        <span class="font-bold ml-2">AvoRed</span>
    </div>

    <div class="space-x-8 p-2">
        <nav aria-label="Main" class="flex-1 px-2 py-4 space-y-2 overflow-y-hidden hover:overflow-y-auto">
            <!-- Dashboards links -->
            <div x-data="{ isActive: false, open: false}">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" x-on:click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-white transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm"> Dashboards </span>
                    <span class="ml-auto" aria-hidden="true">
                        <!-- active class 'rotate-180' -->
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div role="menu" x-show="open" class="mt-2 space-y-2 px-8" aria-label="Dashboards">
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                        Default
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Project Mangement (soon)
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        E-Commerce (soon)
                    </a>
                </div>
            </div>


            <!-- Pages links -->
            <div x-data="{ isActive: false, open: false }">
                <!-- active classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" x-on:click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-white transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm"> Pages </span>
                    <span aria-hidden="true" class="ml-auto">
                        <!-- active class 'rotate-180' -->
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-8" role="menu" arial-label="Pages">
                    <!-- active & hover classes 'text-white dark:text-light' -->
                    <!-- inActive classes 'text-white dark:text-white' -->
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                        Blank
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                        404
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                        500
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                        Profile (soon)
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Pricing (soon)
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Kanban (soon)
                    </a>
                    <a href="#" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Feed (soon)
                    </a>
                </div>
            </div>

            <!-- Authentication links -->
            <div x-data="{ isActive: false, open: false}">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" x-on:click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-white transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm"> Authentication </span>
                    <span aria-hidden="true" class="ml-auto">
                        <!-- active class 'rotate-180' -->
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-8" role="menu" aria-label="Authentication">
                    <!-- active & hover classes 'text-white dark:text-light' -->
                    <!-- inActive classes 'text-white dark:text-white' -->
                    <a href="../auth/register.html" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Register
                    </a>
                    <a href="../auth/login.html" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Login
                    </a>
                    <a href="../auth/forgot-password.html" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Forgot Password
                    </a>
                    <a href="../auth/reset-password.html" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:hover:text-light hover:text-white">
                        Reset Password
                    </a>
                </div>
            </div>

            <!-- Layouts links -->
            <div x-data="{ isActive: true, open: true}">
                <!-- active & hover classes 'bg-primary-100 dark:bg-primary' -->
                <a href="#" x-on:click="$event.preventDefault(); open = !open"
                    class="flex items-center p-2 text-white transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
                    :class="{'bg-primary-100 dark:bg-primary': isActive || open}" role="button" aria-haspopup="true"
                    :aria-expanded="(open || isActive) ? 'true' : 'false'">
                    <span aria-hidden="true">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                        </svg>
                    </span>
                    <span class="ml-3 text-sm"> Layouts </span>
                    <span aria-hidden="true" class="ml-auto">
                        <!-- active class 'rotate-180' -->
                        <svg class="w-4 h-4 transition-transform transform" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </span>
                </a>
                <div x-show="open" class="mt-2 space-y-2 px-8" role="menu" aria-label="Layouts">
                    <!-- active & hover classes 'text-white dark:text-light' -->
                    <!-- inActive classes 'text-white dark:text-white' -->
                    <a href="two-columns-sidebar.html" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-light dark:hover:text-light hover:text-white">
                        Two Columns Sidebar
                    </a>
                    <a href="mini-plus-one-columns-sidebar.html" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                        Mini + One Columns Sidebar
                    </a>
                    <a href="mini-column-sidebar.html" role="menuitem"
                        class="block p-2 text-sm text-white transition-colors duration-200 rounded-md dark:text-white dark:hover:text-light hover:text-white">
                        Mini Column Sidebar
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
