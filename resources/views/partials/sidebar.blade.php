<a-layout-sider :style="{background: '#fff'}" :trigger="null" collapsible v-model="collapsed">
    <a href="{{ route('admin.dashboard') }}" class="flex items-center mt-2">
        <img class="h-12 block ml-8 w-12" src="{{ asset('vendor/avored/images/logo_only.svg') }}" />
        <div class="text-xl text-red-600">AvoRed</div>
    </a>
    <a-menu 
        theme="light"
        :default-selected-keys="['{{ $currentMenuItemKey }}']"
        :default-open-keys="['{{ $currentOpenKey }}']"
        mode="inline">
    @foreach ($adminMenus as $key => $adminMenu)
        @if ($adminMenu->hasSubmenu())
            <a-sub-menu key="{{ $key }}">
                <span slot="title">
                    @if ($adminMenu->icon() !== null)
                        <a-icon type="{{ $adminMenu->icon() }}"></a-icon>
                    @endif
                    <span>{{ $adminMenu->label() }}</span>
                </span>
                @foreach ($adminMenu->subMenu($key) as $subMenu)
                    <a-menu-item key="{{ $subMenu->key() }}">
                        <a href="{{ route($subMenu->route()) }}">
                            {{ $subMenu->label() }}
                        </a>
                    </a-menu-item>
                @endforeach
            </a-sub-menu>
        @endif
    @endforeach
    </a-menu>

        
    </a-menu>
</a-layout-sider>
