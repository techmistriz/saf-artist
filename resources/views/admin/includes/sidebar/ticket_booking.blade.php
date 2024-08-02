<li class="menu-item menu-item-submenu {{ $helper->isActivate(['admin.ticket_booking.index', 'admin.ticket_booking.edit']) }}" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="la la-ticket icon-2x"></i>
        </span>
        <span class="menu-text">Ticket Booking</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">Ticket Booking</span>
                </span>
            </li>
            <li class="menu-item {{ $helper->isActivate(['admin.ticket_booking.index']) }}" aria-haspopup="true">
                <a href="{{route('admin.ticket_booking.index')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">List</span>
                </a>
            </li>
            <!-- <li class="menu-item {{ $helper->isActivate(['admin.ticket_booking.create']) }}" aria-haspopup="true">
                <a href="{{route('admin.ticket_booking.create')}}" class="menu-link">
                    <i class="menu-bullet menu-bullet-dot">
                        <span></span>
                    </i>
                    <span class="menu-text">Add</span>
                </a>
            </li> -->
        </ul>
    </div>
</li>