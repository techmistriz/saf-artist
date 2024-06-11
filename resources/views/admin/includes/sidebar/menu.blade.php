@php 
    $helper     =   new \App\Helpers\Helper;
@endphp
<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
    <!--begin::Menu Container-->
    <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
            <li class="menu-item {{$helper->isActivate(['admin.dashboard'])}}" aria-haspopup="true">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <span class="svg-icon menu-icon">
                        <i class="flaticon-layer"></i>
                    </span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            
            @php

            $rolePermissionArr = session('rolePermission');

            @endphp

            @if(\Helper::checkPermisson('UserController', $rolePermissionArr))
                @include('admin/includes/sidebar/user')
            @endif

            @if(\Helper::checkPermisson('UserProfileController', $rolePermissionArr))
                @include('admin/includes/sidebar/user_profile')
            @endif

            @if(\Helper::checkPermisson('ProfileMemberController', $rolePermissionArr))
                @include('admin/includes/sidebar/profile_member')
            @endif

            @if(\Helper::isSuperAdmin('FaqController', $rolePermissionArr))
                @include('admin/includes/sidebar/faq')
            @endif
            
            @if(\Helper::checkPermisson('ProjectController', $rolePermissionArr))
                @include('admin/includes/sidebar/project')
            @endif
            <li class="menu-section">
                <h4 class="menu-text">Masters</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

        	@if(\Helper::checkPermisson('CategoryController', $rolePermissionArr))
            	@include('admin/includes/sidebar/category')
            @endif

            @if(\Helper::checkPermisson('VenueController', $rolePermissionArr))
                @include('admin/includes/sidebar/venue')
            @endif

            @if(\Helper::checkPermisson('CuratorController', $rolePermissionArr))
                @include('admin/includes/sidebar/curator')
            @endif

            @if(\Helper::checkPermisson('ArtistTypeController', $rolePermissionArr))
                @include('admin/includes/sidebar/artist_type')
            @endif 

            @if(\Helper::checkPermisson('FestivalController', $rolePermissionArr))
                @include('admin/includes/sidebar/festival')
            @endif 

            @if(\Helper::checkPermisson('PincodeController', $rolePermissionArr))
                @include('admin/includes/sidebar/pincode')
            @endif            
            
            <!-- New Section Start -->
            <li class="menu-section">
                <h4 class="menu-text">Settings</h4>
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
            </li>

            @if(\Helper::isSuperAdmin('AdminUserControllerController', $rolePermissionArr))
                @include('admin/includes/sidebar/admin_user')
            @endif            

            @if(\Helper::isSuperAdmin('UserRoleController', $rolePermissionArr))
                @include('admin/includes/sidebar/role')
            @endif

            @if(\Helper::isSuperAdmin('AdminModuleController', $rolePermissionArr))
                @include('admin/includes/sidebar/admin_module')
            @endif

        	@if(\Helper::checkPermisson('SmsTemplateController', $rolePermissionArr) || \Helper::checkPermisson('EmailTemplateController', $rolePermissionArr))
            	@include('admin/includes/sidebar/template', $rolePermissionArr)

            @endif

         	@if(\Helper::isSuperAdmin('SystemSettingsController', $rolePermissionArr))
            	@include('admin/includes/sidebar/system_settings')
            @endif

        </ul>
        <!--end::Menu Nav-->
    </div>
    <!--end::Menu Container-->
</div>