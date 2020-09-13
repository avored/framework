<div class="flex items-center">
    <div class="w-1/2">
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::system.fields.name') }}"
                field-name="name"
                :is-disabled="true"
                init-value="{{ $menuGroup->name ?? '' }}" 
                error-text="{{ $errors->first('name') }}"
            ></avored-input>
        </div>
    </div>
    <div class="w-1/2 ml-3">
        <div class="mt-3 flex w-full">
            <avored-input
                label-text="{{ __('avored::system.fields.identifier') }}"
                field-name="identifier"
                :is-disabled="true"
                init-value="{{ $menuGroup->identifier ?? '' }}" 
                error-text="{{ $errors->first('identifier') }}"
            ></avored-input>
        </div>
    </div>
</div>

<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.type') }}"
        field-name="type"
        @input="changeMenuType"
        :options="{{ json_encode($menuTypeOptions) }}"
        init-value="{{ $menu->type ?? '' }}" 
        error-text="{{ $errors->first('type') }}"
    ></avored-select>
</div>

<div class="mt-3 flex w-full"  v-if="type==='CUSTOM'">
    <avored-input
        label-text="{{ __('avored::system.fields.url') }}"
        field-name="route_info"
        init-value="{{ $menu->route_info ?? '' }}" 
        error-text="{{ $errors->first('route_info') }}"
    ></avored-input>
</div>

<div class="mt-3 flex w-full" v-if="type==='CATEGORY'">
    <avored-select
        label-text="{{ __('avored::system.fields.category_route') }}"
        field-name="route_info"
        init-value="{{ $menu->route_info ?? '' }}"
        :options="{{ json_encode($categoryOptions) }}"
        error-text="{{ $errors->first('route_info') }}"
    ></avored-select>
</div>


<div class="mt-3 flex w-full" v-if="type==='FRONT_MENU'">
    <avored-select
        label-text="{{ __('avored::system.fields.front_menu_route') }}"
        field-name="route_info"
        :options="{{ json_encode($frontMenuOptions) }}"
        init-value="{{ $menu->route_info ?? '' }}" 
        error-text="{{ $errors->first('route_info') }}"
    ></avored-select>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.name') }}"
        field-name="name"
        init-value="{{ $menu->name ?? '' }}" 
        error-text="{{ $errors->first('name') }}"
    ></avored-input>
</div>

<div class="mt-3 flex w-full">
    <avored-select
        label-text="{{ __('avored::system.fields.parent_id') }}"
        field-name="parent_id"
        :options="{{ json_encode($existedMenus) }}"
        init-value="{{ $menu->parent_id ?? '' }}" 
        error-text="{{ $errors->first('parent_id') }}"
    ></avored-select>
</div>

<div class="mt-3 flex w-full">
    <avored-input
        label-text="{{ __('avored::system.fields.sort_order') }}"
        field-name="sort_order"
        init-value="{{ $menuav->sort_order ?? '' }}" 
        error-text="{{ $errors->first('sort_order') }}"
    ></avored-input>
</div>
