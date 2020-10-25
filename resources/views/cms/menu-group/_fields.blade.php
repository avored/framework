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
<div class="mt-5">
    <div class="border p-5">
        <div class="text-gray-800 flex items-center">
            <div class="text-xl text-red-700 font-semibold">
                {{ __('avored::system.pages.title.list', ['attribute' => __('avored::system.terms.menu')]) }}
            </div>
            <div class="ml-auto">
                <a href="{{ route('admin.menu.create', ['menuGroup' => $menuGroup->id]) }}"
                    class="px-4 py-2 font-semibold leading-7 text-white hover:text-white bg-red-600 rounded hover:bg-red-700"
                >
                    <svg class="w-5 h-5 inline-block text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17 11a1 1 0 0 1 0 2h-4v4a1 1 0 0 1-2 0v-4H7a1 1 0 0 1 0-2h4V7a1 1 0 0 1 2 0v4h4z"/>
                    </svg>
                    {{ __('avored::system.btn.create') }}
                </a>
            </div>
        </div>

        <div class="mt-5">
            <menu-table
                :init-menus="{{ json_encode($menus) }}"
                :menu-group="{{ json_encode($menuGroup) }}"
                base-url="{{ asset(config('avored.admin_url')) }}"
                filter-url="{{ route('admin.menu.filter') }}"
            ></menu-table>
        </div>
    </div>
</div>
