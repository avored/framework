<a-layout-sider  :trigger="null" collapsible v-model="collapsed">
    <div class="logo"></div>

    <a-menu theme="dark"  :defaultSelectedKeys="['1']" mode="inline">
        <a-menu-item key="1">
            <a-icon type="user"></a-icon>
            <span>Catalog</span>
        </a-menu-item>
        </a-menu-item>
        <a-menu-item key="2">
            <a-icon type="user"></a-icon>
            <span>Order</span>
        </a-menu-item>
        <a-sub-menu key="sub1">
            <span slot="title">
                <a-icon type="user"></a-icon>
                <span>User</span>
            </span>
            <a-menu-item key="3">Tom</a-menu-item>
            <a-menu-item key="4">Bill</a-menu-item>
            <a-menu-item key="5">Alex</a-menu-item>
        </a-sub-menu>

        <a-sub-menu key="sub2">
            <span slot="title">
                <a-icon type="user"></a-icon>
                <span>Team</span>
            </span>
            <a-menu-item key="6">Team 1</a-menu-item>
            <a-menu-item key="8">Team 2</a-menu-item>
        </a-sub-menu>
    </a-menu>
</a-layout-sider>
