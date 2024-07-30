<li class="menu-item menu-item-submenu {{ $helper->isActivate([ 'admin.report.create']) }}" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="flaticon2-checking icon-2x"></i>
        </span>
        <span class="menu-text">Reports</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">Reports</span>
                </span>
            </li>
            <li class="menu-item {{ $helper->isActivate(['admin.report.create']) }}" aria-haspopup="true">
                <a href="{{route('admin.report.create')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Export</span>
                </a>
            </li>
        </ul>
    </div>
</li>