@extends('avored::layouts.app')

@section('meta_title')
    {{ __('avored::cms.menu.create.title') }}: AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    {{ __('avored::cms.menu.create.title') }}
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <menu-save 
            :prop-categories="{{ $categories }}" 
            base-url="{{ asset(config('avored.admin_url')) }}" 
            inline-template>
        <div>
            <a-row :gutter="30" class="menu-create-page">
                <a-form 
                    :form="form" 
                    v-on:submit="handleSubmit"
                    method="post" 
                    action="{{ route('admin.menu.store') }}">
                
                @csrf
                <input type="hidden" name="menu_json" v-model="menu_json" />
                <a-col :span="24">
                    <a-form-item
                        @if ($errors->has('name'))
                            validate-status="error"
                            help="{{ $errors->first('name') }}"
                        @endif
                        label="{{ __('avored::cms.menu.name') }}"
                    >
                        <a-input
                            :auto-focus="true"
                            name="name"
                            v-decorator="[
                            'name',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'name']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="24">
                    <a-form-item
                        @if ($errors->has('identifier'))
                            validate-status="error"
                            help="{{ $errors->first('identifier') }}"
                        @endif
                        label="{{ __('avored::cms.menu.identifier') }}"
                    >
                        <a-input
                            name="identifier"
                            v-decorator="[
                            'identifer',
                            {rules: 
                                [
                                    {   required: true, 
                                        message: '{{ __('avored::validation.required', ['attribute' => 'Identifier']) }}' 
                                    }
                                ]
                            }
                            ]"
                        ></a-input>
                    </a-form-item>
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
                 <a-col class="mt-1" :span="24">
                    <a-form-item>
                    <a-button
                        type="primary"
                        html-type="submit"
                    >
                        {{ __('avored::system.btn.save') }}
                    </a-button>
                    
                    <a-button
                        class="ml-1"
                        type="default"
                        v-on:click.prevent="cancelMenu"
                    >
                        {{ __('avored::system.btn.cancel') }}
                    </a-button>
                </a-form-item>
                </a-col>
                </a-form>
            </a-row>
        </div>
        </menu-save>
    </a-col>
</a-row>
@endsection
