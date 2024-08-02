@include('flash::message')
<style type="text/css">
	.radio {
		display: -webkit-box;
	}

	.image-input {
	    margin-right: 10px;
	}

</style>
<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}}</h3>
                </div>
            </div>
            
            <div class="card-body" id="artist">
                <div class="row">

                	<div class="col-6">
                        <div class="form-group">
                            <label>User Type<span class="asterisk">*</span></label>
                            <select class="form-control form-control-lg form-control-custom selectpicker" name="frontend_role_id" tabindex="null" onchange="groupFieldShow()">
                                <option value="">Select Role</option>
                                @if($frontendRoles->count())
                                    @foreach($frontendRoles as $value)
                                        <option {{ (old('frontend_role_id') ?? optional($row)->frontend_role_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('frontend_role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Category <span class="asterisk">*</span></label>
                                <select name="category_id" id="category_id" class="form-control form-control-lg form-control-custom selectpicker @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>

                                @if($categories->count())
                                    @foreach($categories as $value)
                                        <option value="{{$value->id}}" {{ old('category_id', $row->category_id ?? 0) == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                    @endforeach
                                @endif

                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Artist Type<span class="asterisk">*</span></label>
                            <select name="artist_type_id" id="artist_type_id" class="form-control form-control-lg form-control-custom selectpicker @error('artist_type_id') is-invalid @enderror">
                                <option value="">Select Artist Type</option>

                                @if($artistTypes->count())
                                    @foreach($artistTypes as $value)
                                        <option value="{{$value->id}}" {{ old('artist_type_id', $row->artist_type_id ?? 0) == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                    @endforeach
                                @endif

                            </select>
                            @error('artist_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Name of Curators <span class="asterisk">*</span></label>
                            <select name="curator_name" id="curator_name" class="form-control form-control-lg form-control-custom selectpicker @error('curator_name') is-invalid @enderror">
                                <option value="">Select Curator</option>

                                @if($curators->count())
                                    @foreach($curators as $value)
                                        <option value="{{$value->name}}" {{ old('curator_name', $row->curator_name ?? '') == $value->name ? 'selected' : '' }}>{{$value->name}}</option>
                                    @endforeach
                                @endif

                            </select>
                            @error('curator_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Full Name </label>
                            <input type="text" name="name" value="{{ old('name', $row->name ?? '') }}" class="form-control" placeholder="Enter Full Name"/>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label>Contact </label>
                            <input type="text" oninput="this.value=this.value.replace(/[^0-9]/, '')" name="contact" value="{{ old('contact') ? old('contact') :( isset($row->contact) ? $row->contact : '') }}" class="form-control"  minlength="10" maxlength="10"  placeholder="Enter Contact"/>
                            @error('contact')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label>Email </label>
                            <input type="text" name="email" value="{{ old('email') ? old('email') : ( isset($row->email) ? $row->email : '') }}" class="form-control" placeholder="Enter Email"/>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label>Password </label>
                            <input type="password" name="password" value="" class="form-control" placeholder="Enter Password" autocomplete="new-password" />
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group">
                            <label>Confirm Password </label>
                            <input type="password" name="password_confirm" value="" class="form-control" placeholder="Enter Confirm Password" autocomplete="new password_confirm" />
                            @error('password_confirm')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <label>Image</label>
                        <div class="form-group">
                            <div class="image-input image-input-outline" id="profile_image_1" style="background-image: url('{{asset("media/users/blank_Img.jpg")}}')">

                                @if(isset($row->profile_image_1) && !empty($row->profile_image_1))
                                    <div class="image-input-wrapper" style="background-image:url('{{asset("uploads/users/".$row->profile_image_1)}}')"></div>
                                @else
                                    <div class="image-input-wrapper profile_image_1_base64"></div>
                                @endif

                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                    <input type="file" name="profile_image_1" accept=".png, .jpg, .jpeg"/>
                                    <input type="hidden" name="profile_image_1_remove"/>
                                </label>

                                @if(isset($row->profile_image_1) && !empty($row->profile_image_1))
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                @else
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                @endif
                            </div>
                        </div>
                        @error('profile_image_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>                
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a class="btn btn-light-danger" href="{{ route($moduleConfig['routes']['listRoute']) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">	
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
</script>
@endpush