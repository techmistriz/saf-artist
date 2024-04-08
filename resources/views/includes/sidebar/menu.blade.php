@php 
    $helper     =   new \App\Helpers\Helper;
@endphp
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item menu-item-active {{$helper->isActivate(['home'])}}" aria-haspopup="true">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <i class="flaticon-layer"></i>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>

            <!-- New Section Start -->
            @include('includes/sidebar/admin_user')
            @include('includes/sidebar/user')
            @include('includes/sidebar/role')
            @include('includes/sidebar/vanue')
            @include('includes/sidebar/vibes')
            @include('includes/sidebar/curator')
            @include('includes/sidebar/media')
            @include('includes/sidebar/program')
            @include('includes/sidebar/contact_us')
            
            <li class="menu-section">
                <h4 class="menu-text">Masters</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            @include('includes/sidebar/discipline')
            @include('includes/sidebar/accessibility')
            @include('includes/sidebar/category')
            @include('includes/sidebar/program_tag')
            @include('includes/sidebar/admin_module')
            
            <!-- New Section Start -->
            <li class="menu-section">
                <h4 class="menu-text">Settings</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>
         	@include('includes/sidebar/template')
         	@include('includes/sidebar/system_settings')
            
            
        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>