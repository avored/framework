@extends('avored-framework::layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="h1">Menu</div>
            <div class="row">
                <div class="col-md-6">
                    <div class="col-md-6">
                        <div class="h4">Categories List</div>
                        <ul class="left-menu list-group ">

                            @foreach($categories as $category)
                                <li id="category-{{ $category->id }}"" class="list-group-item mb-2"
                                    draggable="true"
                                    data-route="category.view"
                                    data-params="{{ $category->slug }}"
                                    data-name="{{ $category->name }}"
                                >
                                    <i class="ti-menu-alt"></i>
                                    <a href="#"
                                       data-route="{{ route('category.view', $category->slug) }}">{{ $category->name }}</a>
                                    <span class="float-right">
                                    <a href="#" class="destroy-menu"><i class="ti-trash"></i> </a>
                                </span>
                                </li>
                            @endforeach

                        </ul>
                        <div class="h4">Front Menu List</div>
                        <ul class="left-menu list-group ">

                            @foreach($frontMenus as $frontMenu)
                                <li class="list-group-item mb-2"
                                    data-route="{{ $frontMenu->route() }}"
                                    data-params="{{ $frontMenu->params() }}"
                                    data-name="{{ $frontMenu->label() }}"
                                >
                                    <i class="ti-menu-alt"></i>
                                    <a href="#"
                                       data-route="{{ route($frontMenu->route()) }}"
                                    >{{ $frontMenu->label() }}</a>
                                    <span class="float-right">
                                    <a href="#" class="destroy-menu"><i class="ti-trash"></i> </a>
                                </span>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <ul id='menu-nav-list' class="nav nav-tabs nav-fill">
                        @foreach($menuGroups as $menuGroup)
                        <li class="nav-item ">
                            @if ($loop === 0)
                                @php 
                                $class = 'active';
                                @endphp
                            @else 
                                @php 
                                $class = '';
                                @endphp
                            @endif
                            <a class="nav-link bg-primary text-white {{ $class }}" 
                                data-toggle="tab" 
                                href="#{{ $menuGroup->identifier }}">{{ $menuGroup->name }}</a>
                        </li>
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab"  href="#add-menu-group">
                                <i class='ti-plus'>&nbsp;</i>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                    @foreach($menuGroups as $menuGroup)
                         @if ($loop === 0)
                            @php 
                            $class = 'active';
                            @endphp
                        @else 
                            @php 
                            $class = '';
                            @endphp
                        @endif
                        <div class="tab-pane border fade {{ $class }} show" id="{{ $menuGroup->identifier }}">
                            <div class="pl-3 pr-3">
                                <form action="{{ route('admin.menu.store') }}" class="mt-3" method="post">

                                    <div class="form-group">
                                        <label>Menu Name</label>
                                        <input type="text" name="name" value="{{ $menuGroup->name }}" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Menu Identifier</label>
                                        <input type="text" name="identifier" value="{{ $menuGroup->identifier }}" class="form-control" />
                                    </div>

                                    @php
                                        $menus = $menuGroup->menus;
                                        
                                    @endphp
                                    <div class="display-menu-tree">
                                       <ul data-identifier="{{ $menuGroup->identifier }}" class="dropable-menu-tree">
                                           <li></li>
                                            @include('avored-framework::cms.menu.menu-tree', ['menus' => $menus])
                                       </ul>
                                    </div>
                                
                                    @csrf
                                    <input type="hidden" name="menu_json" class="menu-json" value=""/>
                                    <input type="hidden" name="menu_group_id" value="{{ $menuGroup->id }}"/>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Menu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach

                        <div class="tab-pane fade" id="add-menu-group">
                            <div class="pl-3 pr-3">
                                <form action="{{ route('admin.menu.store') }}" class="mt-3" method="post">
                                    <div class="form-group">
                                        <label>Menu Name</label>
                                        <input type="text" name="name" value="" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label>Menu Identifier</label>
                                        <input type="text" name="identifier" value="" class="form-control" />
                                    </div>
                                  
                                    <div class="display-menu-tree">
                                       <ul data-identifier="add-new-group" class="dropable-menu-tree">
                                           <li></li>
                                            @include('avored-framework::cms.menu.menu-tree', ['menus' => []])
                                       </ul>
                                    </div>
                                
                                    @csrf
                                    <input type="hidden" name="menu_json" class="menu-json" value=""/>
                                    <input type="hidden" name="menu_group_id" value=""/>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Save Menu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
               
            </div>
        </div>
    </div>

@endsection
