<style type="text/css">
    .profile-img-form .image-input {
        margin-right: 10px;
    }
    .profile-img-form .image-input .image-input-wrapper {
        width: 120px !important;
        height: 120px !important;
    }

</style>

<div class="hamburgermenu">
<a class="nav-toggle"><span></span></a>
</div>

<div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
    <!--begin::Nav Panel Widget 2-->
    <div class="card card-custom gutter-b">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Wrapper-->
            <div class="d-flex justify-content-between flex-column pt-4 h-100">
                <!--begin::Container-->
                <div class="pb-5">
                    <!--begin::Header-->
                    <div class="d-flex flex-column flex-center">
                        <!--begin::Symbol-->

                        <form action="{{ route('update.profile.picture') }}" method="POST" enctype="multipart/form-data" id="profile-picture-form" class="profile-img-form">
				            <input type="hidden" name="_method" value="PUT">
				            {{ csrf_field() }}

							<div class="image-input image-input-outline image-input-circle" id="profile_image" style="background-image: url({{asset('media/users/blank.png')}})">

	                    		@if(!empty(Auth::user()->profile_image_1))
									<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.Auth::user()->profile_image_1)}})"></div>
	                    		@else
	                    			<div class="image-input-wrapper profile_image_1_base64"></div>
	                    		@endif

								<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
									<i class="fa fa-pen icon-sm"></i>
									<input type="file" name="profile_image" accept=".png, .jpg, .jpeg"/>
								</label>
							</div>
						</form>

                        <!--end::Symbol-->
                        <!--begin::Username-->
                        <a href="{{ route('dashboard') }}" class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">{{ Auth::user()->name }}</a>
                        <!--end::Username-->
                        <!--begin::Info-->
                        <div class="font-weight-bold text-dark-50 font-size-sm">{{ Auth::user()->email }}</div>
                        <div class="font-weight-bold text-dark-50 font-size-sm pb-5">{{ Auth::user()->getAge() }}</div>
                        <div class="pb-6">                           
                            <a href="#" class="theme-btn mt-0 mb-0" style="padding: 12px 9px;">Submit for Review</a>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="pt-1">
                        
                        <!--begin::Item-->
                        <div class="d-flex align-items-center pb-9">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-user icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('dashboard') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Profile/Dashboard</a>
                                <span class="text-muted font-weight-bold">Profile/Dashboard</span>
                            </div>
                            <!--end::Text-->
                        </div>


                        @if(isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Troupe and Group'))
                       
                            <div class="d-flex align-items-center pb-9">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45 symbol-light mr-4">
                                    <span class="symbol-label">
                                        <i class="flaticon-users icon-xl"></i>
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Text-->
                                <div class="d-flex flex-column flex-grow-1">
                                    <a href="{{route('group.member.list')}}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Members List</a>
                                    <span class="text-muted font-weight-bold">Members List</span>
                                </div>
                                <!--end::Text-->
                            </div>
                                       
                        @endif
                        

                        <!--begin::Item-->
                        <div class="d-flex align-items-center pb-9">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-user-edit icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('edit.category.details') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Project Category Details</a>
                                <span class="text-muted font-weight-bold">Project Category Details</span>
                            </div>
                            <!--end::Text-->
                        </div>

                        <div class="d-flex align-items-center pb-9">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-bank  icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('edit.account.details') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Banking Details</a>
                                <span class="text-muted font-weight-bold">Banking Details</span>
                            </div>
                            <!--end::Text-->
                        </div>

                        <div class="d-flex align-items-center pb-9">
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-plane  icon-xl"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="dropdown">
                                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder dropdown-toggle" id="ticketDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ticket Booking</a>
                                    @if(isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual'))
                                        <div class="dropdown-menu" aria-labelledby="ticketDropdown">
                                            <a class="dropdown-item" href="{{ route('ticket.booking.edit', Auth::user()->id) }}">Edit Ticket Booking</a>
                                        </div>
                                    @else
                                        <div class="dropdown-menu" aria-labelledby="ticketDropdown">
                                            <a class="dropdown-item" href="{{ route('ticket.booking.create') }}">Add Ticket Booking</a>
                                            <a class="dropdown-item" href="{{ route('ticket.booking.list') }}">Ticket Booking List</a>
                                        </div>
                                    @endif
                                </div>
                                <span class="text-muted font-weight-bold">Ticket Booking</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center pb-9">
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-plane  icon-xl"></i>
                                </span>
                            </div>
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="dropdown">
                                    <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder dropdown-toggle" id="hotelDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hotel Booking</a>
                                    @if(isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual'))
                                        <div class="dropdown-menu" aria-labelledby="ticketDropdown">
                                            <a class="dropdown-item" href="{{ route('hotel.booking.edit', Auth::user()->id) }}">Edit Hotel Booking</a>
                                        </div>
                                    @else
                                        <div class="dropdown-menu" aria-labelledby="hotelDropdown">
                                            <a class="dropdown-item" href="{{ route('hotel.booking.create') }}">Add Hotel Booking</a>
                                            <a class="dropdown-item" href="{{ route('hotel.booking.list') }}">Hotel Booking List</a>
                                        </div>
                                    @endif                                    
                                </div>
                                <span class="text-muted font-weight-bold">Hotel Booking</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center pb-9">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-sign-out  icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('edit.account.details') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder" onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">Logout</a>

                                <form id="logout-form-header" action="{{ route('logout') }}" method="POST" style="display: none;">
				                    {{ csrf_field() }}
			                  	</form>

                                <span class="text-muted font-weight-bold">Logout from your account</span>
                            </div>
                            <!--end::Text-->
                        </div>

                        <!--end::Item-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--eng::Container-->
                
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Nav Panel Widget 2-->
    
</div>
@push('scripts')
<script type="text/javascript">

	// START profile_image
    var profile_image = new KTImageInput('profile_image');
	profile_image.on('change', function(imageInput) {
		
		document.getElementById('profile-picture-form').submit();

	});

	// END profile_image

    $('.nav-toggle').click(function() {
    $(this).toggleClass('active');
    $('.offcanvas-mobile').toggleClass('open');
});

</script>
@endpush