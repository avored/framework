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
        <menu-save :categories="{{ $categories }}" base-url="{{ asset(config('avored.admin_url')) }}" inline-template>
        <div>
            <a-row>
                <a-col :span="12">

                    <p>Left side</p>
                        <div class="ant-list ant-list-split ant-list-bordered mr-1">
                            <draggable :list="categories" group="category" class="ant-spin-container">
                                <div v-for="item in categories" :key="item.id" class="ant-list-item">
                                    @{{ item.name }}
                                </div>
                            </draggable>
                        </div>
                </a-col>
                <a-col :span="12">
                    <p>Right SIde</p>
                    <div class="ant-list ant-list-split ant-list-bordered">
                        <draggable :list="list2" group="category" @change="updateMenu" class="ant-spin-container">
                            <div v-for="item in list2" :key="item.id" class="ant-list-item">
                                @{{ item.name }}
                            </div>
                        </draggable>

                    </div>
                    @{{ list2 }}
                </a-col>
            </a-row>

        </div>
        </menu-save>
    </a-col>
</a-row>
@endsection
