<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{ route('admin.dashboard') }}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo">
                                    <img src="http://avored.shop/vendor/avored-default/images/logo.svg" alt="" height="50" width="60">
                                </div>
                            </div>

                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">Avored</h5>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle">
                        <a href="" class="td-n"><i class="ti-arrow-circle-left"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <ul class="sidebar-menu scrollable pos-r">
            <li class="nav-item mT-30 active">
                <a class="sidebar-link" href="{{ route('admin.dashboard') }}">
                    <span class="icon-holder"><i class="c-white-500 ti-home"></i></span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            @if(isset($adminMenus))
                @foreach($adminMenus as $key => $menu)
                    @if(null !== $menu->subMenu() && count($menu->subMenu()) > 0)
                        <?php $subMenu = $menu->subMenu(); ?>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder"> <i class="c-white-500 {{ $menu->icon() }}"></i></span>
                                <span class="title"> {{ $menu->label() }}</span>
                                <span class="arrow"> <i class="ti-angle-right"></i></span>
                            </a>

                            <ul class="dropdown-menu">
                                @foreach($subMenu as $subKey => $subMenuObj)
                                    <li><a class='sidebar-link' href="{{ route($subMenuObj->route()) }}">{{ $subMenuObj->label() }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li class="nav-item mT-30 active">
                            <a class="sidebar-link" href="index.html">
                                <span class="icon-holder"> <i class="c-blue-500 {{ $menu->icon() }}"></i></span>
                                <span class="title"> {{ $menu->label() }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
    </div>
</div>