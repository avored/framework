    <input type="hidden" name="menu_json" v-model="menu_json" />
    <a-col :span="24">
        
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::cms.menu.name') }}"
                field-name="name"
                init-value="{{ $menuGroup->name ?? '' }}" 
                error-text="{{ $errors->first('name') }}"
            >
            </avored-input>
        </div>
        
    </a-col>
    <a-col :span="24">
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::cms.menu.identifier') }}"
                field-name="identifier"
                init-value="{{ $menuGroup->identifier ?? '' }}" 
                error-text="{{ $errors->first('identifier') }}"
            >
            </avored-input>
        </div>
    </a-col>
    <a-col :span="24">
        <a-card title="{{ __('avored::cms.menu.builder') }}">
            <a-col :span="12">
                <h4>{{ __('avored::cms.menu.category_list') }}</h4>
                <div class="ant-list menu-builder-list ant-list-split ant-list-bordered mr-1">
                    <vddl-list disabled-if="true" :drop="handleDrop" :wrapper="categories"  :list="categories">
                        <vddl-draggable
                            :draggable="item"
                            effect-allowed="copy"
                            class="menu-item"
                            :index="index"
                            :wrapper="categories"
                            :key="'category-' + item.id"
                            v-for="(item, index) in categories">
                        @{{item.name}}
                        </vddl-draggable>
                    </vddl-list>
                </div>

                <h4 class="mt-1">{{ __('avored::cms.menu.frontmenu_list') }}</h4>
                <div class="ant-list menu-builder-list ant-list-split ant-list-bordered mr-1">
                    <vddl-list disabled-if="true" :drop="handleDrop" :wrapper="frontMenus"  :list="frontMenus">
                        <vddl-draggable
                            :draggable="item"
                            effect-allowed="copy"
                            class="menu-item"
                            :index="index"
                            :wrapper="frontMenus"
                            :key="'frontmenu-' + item.id"
                            v-for="(item, index) in frontMenus">
                        @{{item.name}}
                        </vddl-draggable>
                    </vddl-list>
                </div>
            </a-col>
            <a-col :span="12">
                <p>{{ __('avored::cms.menu.create.title') }}</p>
                <div class="ant-list menu-builder-list ant-list-split ant-list-bordered">
                    <vddl-list 
                        :wrapper="menus"
                        :drop="handleDrop" 
                        :external-sources="true" 
                        :list="menus">

                        <vddl-draggable
                            :draggable="menu"
                            class="menu-item"
                            :index="index"
                            :wrapper="menus"
                            :key="index"
                            v-for="(menu, index) in menus">
                        
                            @{{menu.name}}

                            <vddl-list 
                                :wrapper="menu.submenus"
                                :drop="handleSubMenuDrop" 
                                :external-sources="true" 
                                :list="menu.submenus">
                                    <vddl-draggable
                                        :draggable="menu.submenus"
                                        class="menu-item"
                                        :index="index"
                                        :wrapper="submenu.submenus"
                                        :key="'submenu-' + submenu.id"
                                        v-for="(submenu, index) in menu.submenus">
                                        @{{ submenu.name }}
                                        <button type="button" @click.prevent="deleteOnClick(menu, true)">
                                            <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
                                            </svg>
                                        </button>
                                    </vddl-draggable>
                            </vddl-list>
                            <button type="button" @click.prevent="deleteOnClick(menu)">
                                <svg class="h-6 w-6" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path class="heroicon-ui" d="M8 6V4c0-1.1.9-2 2-2h4a2 2 0 012 2v2h5a1 1 0 010 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V8H3a1 1 0 110-2h5zM6 8v12h12V8H6zm8-2V4h-4v2h4zm-4 4a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1zm4 0a1 1 0 011 1v6a1 1 0 01-2 0v-6a1 1 0 011-1z"/>
                                </svg>
                            </button>
                        </vddl-draggable>
                    </vddl-list>
                </div>
            </a-col>
        </a-card>    
    </a-col>
