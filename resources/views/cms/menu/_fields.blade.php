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
                            :key="'menu-' + menu.id"
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

                                    </vddl-draggable>
                            </vddl-list>
                        </vddl-draggable>
                    </vddl-list>
                </div>
            </a-col>
        </a-card>    
    </a-col>
