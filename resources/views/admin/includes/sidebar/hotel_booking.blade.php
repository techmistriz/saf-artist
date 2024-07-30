<li class="menu-item menu-item-submenu {{ $helper->isActivate(['admin.hotel_booking.index', 'admin.hotel_booking.edit']) }}" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="la la-hotel icon-2x"></i>
        </span>
        <span class="menu-text">Hotel Booking</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">Hotel Booking</span>
                </span>
            </li>
            <li class="menu-item {{ $helper->isActivate(['admin.hotel_booking.index']) }}" aria-haspopup="true">
                <a href="{{route('admin.hotel_booking.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">List</span>
                </a>
            </li>
            <li class="menu-item {{ $helper->isActivate(['admin.hotel_booking.create']) }}" aria-haspopup="true">
                <a href="{{route('admin.hotel_booking.create')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Add</span>
                </a>
            </li>
        </ul>
    </div>
</li>