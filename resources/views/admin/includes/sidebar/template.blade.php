<li class="menu-item menu-item-submenu {{ $helper->isActivate(['admin.sms_template.index', 'admin.sms_template.create', 'admin.sms_template.edit', 'admin.sms_template.show', 'admin.email_template.index', 'admin.email_template.create', 'admin.email_template.edit', 'admin.email_template.show']) }}" aria-haspopup="true" data-menu-toggle="hover">
    <a href="javascript:;" class="menu-link menu-toggle">
        <span class="svg-icon menu-icon">
            <i class="flaticon2-mail icon-2x"></i>
        </span>
        <span class="menu-text">Templates</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="menu-submenu">
        <i class="menu-arrow"></i>
        <ul class="menu-subnav">
            <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                    <span class="menu-text">Templates</span>
                </span>
            </li>

        	@if(\Helper::checkPermisson('SmsTemplateController', $rolePermissionArr))
            	<li class="menu-item {{ $helper->isActivate(['admin.sms_template.index', 'admin.sms_template.create', 'admin.sms_template.edit', 'admin.sms_template.show']) }}" aria-haspopup="true">
	                <a href="{{route('admin.sms_template.index')}}" class="menu-link">
	                    <i class="menu-bullet menu-bullet-dot">
	                        <span></span>
	                    </i>
	                    <span class="menu-text">Sms Template</span>
	                </a>
	            </li>
            @endif

            @if(\Helper::checkPermisson('EmailTemplateController', $rolePermissionArr))
	            <li class="menu-item {{ $helper->isActivate(['admin.email_template.index', 'admin.email_template.create', 'admin.email_template.edit', 'admin.email_template.show']) }}" aria-haspopup="true">
	                <a href="{{route('admin.email_template.index')}}" class="menu-link">
	                    <i class="menu-bullet menu-bullet-dot">
	                        <span></span>
	                    </i>
	                    <span class="menu-text">Email Template</span>
	                </a>
	            </li>
            @endif
            
        </ul>
    </div>
</li>