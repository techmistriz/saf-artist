<li class="menu-item menu-item-submenu {{ $helper->isActivate(['admin.artist_type.index', 'admin.artist_type.create', 'admin.artist_type.edit']) }}" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="flaticon2-menu-4 icon-2x"></i>
        </span>
        <span class="menu-text">Artist Type</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">Artist Type</span>
                </span>
            </li>
            <li class="menu-item {{ $helper->isActivate(['admin.artist_type.index']) }}" aria-haspopup="true">
                <a href="{{route('admin.artist_type.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">List</span>
                </a>
            </li>
            <li class="menu-item {{ $helper->isActivate(['admin.artist_type.create']) }}" aria-haspopup="true">
                <a href="{{route('admin.artist_type.create')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Add</span>
                </a>
            </li>
        </ul>
    </div>
</li>