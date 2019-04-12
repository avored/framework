@extends('avored-framework::layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="h1">{{ __('avored-framework::cms.menu.title') }}</div>
            <cms-menu-tree 
                :menu-props="{{ $group->menus }}"
                :front-menu-props="{{ $frontMenus }}"
                :cateogry-props="{{ $categories }}"
                inline-template>
            <div>
                <div class="row">

                    <div class="col-md-6">
                        <div class="col-md-6">
                            <div class="h4">{{ __('avored-framework::cms.menu.category_list') }}</div>
                            
                                <draggable
                                    class="left-menu list-group"
                                    group="avored-drag-only"
                                    :list="categories" 
                                >
                                    <li
                                        class="list-group-item"
                                        v-for="(element, index) in categories"
                                        :key="index + '-cateroy'"
                                    >
                                    @{{ element.name }}
                                    </li>
                                </draggable>
                           

                            <div class="h4">Front Menu List</div>
                          
                                <draggable
                                    class="left-menu list-group"
                                    group="avored-drag-only"
                                    :list="frontMenus" 
                                    
                                    
                                >
                                    <li
                                        class="left-menu list-group-item"
                                        v-for="(element, index) in frontMenus"
                                        :key="index + '-front-menu'"
                                    >
                                        @{{ element.name }}
                                    </li>
                                </draggable>
                           
                        </div>
                    </div>
                    <div class="col-md-6">
                        
                        <div class="tab-content">
                            <div class="tab-pane border fade active show" id="{{ $group->identifier }}">
                                <div class="pl-3 pr-3">
                                    <div class="display-menu-tree">
                                        <ul data-identifier="{{ $group->identifier }}" class="dropable-menu-tree">
                                            <draggable
                                                class="list-group"
                                                group="avored-drag-only"
                                                :list="menus" 
                                            >
                                                <li
                                                    class="left-menu list-group-item"
                                                    v-for="(element, index) in menus"
                                                    :key="index + '-menu'"
                                                >
                                                <span>@{{ element.name }}</span>
                                                <a 
                                                    v-on:click="removeMenu(index)" 
                                                    class="float-right"><i class="ti-trash"></i></a>
                                                </li>
                                            </draggable>
                                        </ul>
                                        </div>
                                        <form method="post" action="{{ route('admin.menu.store') }}">
                                        
                                            @csrf
                                            <input type="hidden" name="menu_json" v-model="menuJson" />
                                            <input type="hidden" name="menu_group_id" value="{{ $group->id }}"/>
                                            <div class="form-group">

                                                <button type="submit" class="btn btn-primary">Save Menu</button>
                                            </div>
                                        </form>
                                    </form>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
                <div class="col-md-12">     
                </div>
            </div>
            </cms-menu-tree>
        </div>
    </div>
@endsection
