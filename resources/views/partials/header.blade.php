<a-layout-header class="bg-white z-1 p-0">
    <a-menu class="float-left" mode="horizontal">
        <a-menu-item class="border-b-0">
            <svg 
                xmlns="http://www.w3.org/2000/svg" 
                class="w-4 h-4"
                @click="()=> collapsed = !collapsed"
            ><path d="M1 1h18v2H1V1zm6 8h12v2H7V9zm-6 8h18v2H1v-2zM7 5h12v2H7V5zm0 8h12v2H7v-2zM1 6l4 4-4 4V6z"/>
            </svg>
        </a-menu-item>
    </a-menu>
    <a-menu class="header-nav" mode="horizontal">
        <a-sub-menu key="header-account">
            <span slot="title">
                <a-avatar
                    class="header-avtar" 
                    size="small" 
                    shape="square" 
                    icon="user"></a-avatar>
                {{ Auth::guard('admin')->user()->full_name }}
            </span>
            <a-menu-item key="1">
                <a href="{{ route('admin.logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('admin-logout-form').submit();">
                <a-icon type="logout"></a-icon>
                <span>{{ __('avored::system.header.logout') }}</span>
                </a>
            </a-menu-item>
        </a-sub-menu>
    </a-menu>
     <form id="admin-logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</a-layout-header>
