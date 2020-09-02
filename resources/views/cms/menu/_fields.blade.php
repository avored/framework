    <input type="hidden" name="menu_json" v-model="menu_json" />
        
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::system.fields.name') }}"
                field-name="name"
                init-value="{{ $menuGroup->name ?? '' }}" 
                error-text="{{ $errors->first('name') }}"
            >
            </avored-input>
        </div>
        
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::system.fields.identifier') }}"
                field-name="identifier"
                init-value="{{ $menuGroup->identifier ?? '' }}" 
                error-text="{{ $errors->first('identifier') }}"
            >
            </avored-input>
        </div>
    <div class="mt-3 flex items-center">
        <div class="block rounded w-full border">
            <div class="p-5 text-xl border-b font-semibold">
                {{ __('avored::system.fields.menu_builder') }}
            </div>
            <div class="p-5 flex items-start">
                <div class="w-1/2">
                    <div class="border">
                        <h4 class="text-md text-red-500 p-3 border-b">{{ __('avored::system.fields.category_list') }}</h4>
                        <div class="p-3 border-b">
                            <vddl-list disabled-if="true" :drop="handleDrop" :wrapper="categories"  :list="categories">
                                <vddl-draggable
                                    :draggable="item"
                                    effect-allowed="copy"
                                    class="border-b py-2"
                                    :index="index"
                                    :wrapper="categories"
                                    :key="'category-' + item.id"
                                    v-for="(item, index) in categories">
                                @{{item.name}}
                                </vddl-draggable>
                            </vddl-list>
                        </div>
                    </div>
                    <div class="mt-5 border">
                        <h4 class="p-3 text-md text-red-500 border-b">{{ __('avored::system.fields.frontmenu_list') }}</h4>
                        <div class="p-3">
                            <vddl-list disabled-if="true" :drop="handleDrop" :wrapper="frontMenus"  :list="frontMenus">
                                <vddl-draggable
                                    :draggable="item"
                                    effect-allowed="copy"
                                    class="border-b py-2"
                                    :index="index"
                                    :wrapper="frontMenus"
                                    :key="'frontmenu-' + item.id"
                                    v-for="(item, index) in frontMenus">
                                @{{item.name}}
                                </vddl-draggable>
                            </vddl-list>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 ml-5 border">
                    <h4 class="text-md p-3 border-b text-red-500">{{ __('avored::system.fields.menu_builder') }}</h4>
                    <div class="p-3">
                        <vddl-list 
                            :wrapper="menus"
                            :drop="handleDrop" 
                            :external-sources="true" 
                            :list="menus">

                            <vddl-draggable
                                :draggable="menu"
                                class="border-b py-2"
                                :index="index"
                                :wrapper="menus"
                                :key="index"
                                v-for="(menu, index) in menus">
                                <div class="flex items-center">
                                    @{{menu.name}}

                                    <vddl-list 
                                        :wrapper="menu.submenus"
                                        :drop="handleSubMenuDrop" 
                                        class="block w-full"
                                        :external-sources="true" 
                                        :list="menu.submenus">
                                            <vddl-draggable
                                                :draggable="menu.submenus"
                                                class="menu-item"
                                                :index="index"
                                                :wrapper="submenu.submenus"
                                                :key="'submenu-' + submenu.id"
                                                v-for="(submenu, index) in menu.submenus">
                                                <div class="w-full block">
                                                    <div class="flex items-center">
                                                        @{{ submenu.name }}
                                                        <span class="ml-auto">

                                                            <button type="button" @click.prevent="deleteOnClick(menu, true)">
                                                                <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
                                                                </svg>
                                                            </button>

                                                        </span>
                                                    </div>
                                                </div>
                                            </vddl-draggable>
                                    </vddl-list>

                                    <span class="ml-auto">
                                        <button type="button" @click.prevent="deleteOnClick(menu)">
                                            <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                            </vddl-draggable>
                        </vddl-list>
                    </div>
                </div>
            </div>
        </div>    
    </div>
