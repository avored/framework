<div class="sidebar" style="background: #7328c6">
    <div class="sidebar-inner">
        <div class="sidebar-logo py-2" style="background: #fff">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="{{ route('admin.dashboard') }}">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer" style="flex: 1">
                                <img src="/logo-leadstore.png" width="100%" class="lh-1 mB-0">
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
