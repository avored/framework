<a-layout-sider  :trigger="null" collapsible v-model="collapsed">
    <div class="logo">AvoRed</div>

    <a-menu 
        theme="dark"
        :default-selected-keys="[]"
        :default-open-keys="[]"
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
        @else
            <a-menu-item key="1">
                <a-icon type="user"></a-icon>
                <span>Test</span>
            </a-menu-item>
        @endif
    @endforeach
    </a-menu>

        
    </a-menu>
</a-layout-sider>
