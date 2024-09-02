
<style type="text/css">
    .profile-img-form .image-input {
        margin-right: 10px;
    }
    .profile-img-form .image-input .image-input-wrapper {
        width: 120px !important;
        height: 120px !important;
    }

    .form-progress{
        width: 100%;
    }

    .progress{
        
        background: #ffffff;
        height: 2rem;
    }

    .progress-bar{
        background-color: #FA9917 !important;
        font-size: 15px;
    }

    .progress-bar.zero{
        background: #ffffff!important;
        height: 2rem;
        text-align: center;
        width: 100%;
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

                        <div class="image-input image-input-outline image-input-circle" id="profile_image" style="background-image: url({{asset('media/users/blank.png')}})">

                            @if(!empty(Auth::user()->profile_image_1))
                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.Auth::user()->profile_image_1)}})"></div>
                            @else
                                <div class="image-input-wrapper profile_image_1_base64"></div>
                            @endif

                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                <i class="fa fa-pen" data-toggle="modal" data-target="#userModal"></i>
                            </label>
                        </div>

                        <!--end::Symbol-->                        
                        <!--begin::Username-->
                        <a href="{{ route('dashboard') }}" class="font-weight-bolder text-dark-75 text-hover-primary font-size-h4">{{ Auth::user()->name }}</a>
                        <div class="font-weight-bolder text-dark-75 m-0">{{ Auth::user()->frontendRole->name }}</div>
                        <!--end::Username-->
                        <!--begin::Info-->
                        <div class="font-weight-bold text-dark-50 font-size-sm">{{ Auth::user()->email }}</div>

                        <span class="text-muted font-weight-bold mt-7">Form Completion Status</span>
                        <div class="form-progress">
                            <div class="progress">
                                @if(isset($statusValue) && $statusValue == 0)
                                    <div class="progress-bar zero text-center" role="progressbar" style="width: 100%; color: black;"aria-valuenow="{{$statusValue}}" aria-valuemin="0" aria-valuemax="100">{{$statusValue}}%</div>
                                @else
                                    <div class="progress-bar" role="progressbar" style="width: {{$statusValue}}%;" aria-valuenow="{{$statusValue}}" aria-valuemin="0" aria-valuemax="100">{{$statusValue}}%</div>
                                @endif
                            </div>
                        </div>
                        
                        <!--end::Info-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="pt-5">
                        
                        <!--begin::Item-->
                        <div class="d-flex align-items-center pb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-user icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('dashboard') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Step 1</a>
                                <span class="text-muted font-weight-bold">Profile/Dashboard</span>
                            </div>
                            <!--end::Text-->
                        </div>

                        <div class="d-flex align-items-center pb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-bank  icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('user.account.details.index') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Step 2</a>
                                <span class="text-muted font-weight-bold">Banking Details</span>
                            </div>
                            <!--end::Text-->
                        </div>

                        <div class="d-flex align-items-center pb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-ticket  icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('ticket.booking.list') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Step 3</a>
                                <span class="text-muted font-weight-bold">Ticket Details</span>
                            </div>
                            <!--end::Text-->
                        </div>

                        <div class="d-flex align-items-center pb-8">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45 symbol-light mr-4">
                                <span class="symbol-label">
                                    <i class="la la-hotel  icon-xl"></i>
                                </span>
                            </div>
                            <!--end::Symbol-->

                            <!--begin::Text-->
                            <div class="d-flex flex-column flex-grow-1">
                                <a href="{{ route('hotel.booking.list') }}" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">Step 4</a>
                                <span class="text-muted font-weight-bold">Hotel Details</span>
                            </div>
                            <!--end::Text-->
                        </div>

                        <div class="d-flex align-items-center pb-8">
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

<!-- The Modal -->
<div class="modal" id="userModal">
    <div class="row">
        <div class="col-md-6" style="margin: 0; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <div class="modal-content">
                <form action="{{ route('login.user.profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{Auth::user()->id}}">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit User Profile</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Full Name:</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <input type="text" name="name" value="{{ old('name', Auth::user()->name ?? '') }}" class="form-control" required placeholder="Enter Full Name"/>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <input type="text" name="contact" value="{{Auth::user()->contact}}" class="form-control" required placeholder="Enter Contact" maxlength="10" />
                                        @error('contact')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control form-control-lg form-control-solid" placeholder="Enter Email" readonly />
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Image</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        
                                        <div class="image-input image-input-outline" id="profile_image_1" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">

                                            @if(isset(Auth::user()->profile_image_1) && !empty(Auth::user()->profile_image_1))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.Auth::user()->profile_image_1)}})"></div>
                                            @else
                                                <div class="image-input-wrapper profile_image_1_base64"></div>
                                            @endif

                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="profile_image_1" accept=".png, .jpg, .jpeg"/>
                                                <input type="hidden" name="profile_image_1_remove"/>
                                            </label>

                                            @if(isset(Auth::user()->profile_image_1) && !empty(Auth::user()->profile_image_1))
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            @else
                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                </span>
                                            @endif
                                        </div>

                                        @error('profile_image_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror                                    
                                    </div>
                                    <span style="margin-left: 190px;">Use 300 X 300 size image</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" name="submit" class="theme-btn mt-0 mb-0" >Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>                            
</div>
@push('scripts')
<script type="text/javascript">

    $('.nav-toggle').click(function() {
        $(this).toggleClass('active');
        $('.offcanvas-mobile').toggleClass('open');
    });

    // START profile_image_1
    var profile_image_1 = new KTImageInput('profile_image_1');

    profile_image_1.on('cancel', function(imageInput) {
        swal.fire({
            title: 'Image successfully canceled !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Okay!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    profile_image_1.on('change', function(imageInput) {
        
    });

    profile_image_1.on('remove', function(imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });
    // END profile_image_1

    $(function() {
      $('.chart').easyPieChart({
        size: 160,
        barColor: "#17d3e6",
        scaleLength: 0,
        lineWidth: 15,
        trackColor: "#373737",
        lineCap: "circle",
        animate: 2000,
      });
    });

</script>
@endpush