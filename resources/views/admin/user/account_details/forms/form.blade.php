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
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}} Banking Details</h3>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Full Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control @error('name') is-invalid @enderror " placeholder="Enter Name" readonly="" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">permanent address</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control @error('permanent_address') is-invalid @enderror  no-summernote-editor" name="permanent_address" id="permanent_address" placeholder="Enter Permanent Address" >{{ $user->permanent_address }}</textarea>
                                @error('permanent_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">account number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="account_number" oninput="this.value=this.value.replace(/[^0-9]/, '')" minlength="10" maxlength="20" value="{{ old('account_number') ? old('account_number') :( isset($row->account_number) ? $row->account_number : '') }}" class="form-control @error('account_number') is-invalid @enderror " placeholder="Enter account number"/>
                                @error('account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Re-enter account number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="confirm_account_number" oninput="this.value=this.value.replace(/[^0-9]/, '')" minlength="10" maxlength="20" value="{{ old('confirm_account_number') ? old('confirm_account_number') :( isset($row->confirm_account_number) ? $row->confirm_account_number : '') }}" class="form-control @error('confirm_account_number') is-invalid @enderror " placeholder="Enter Re-enter account number"/>
                                @error('confirm_account_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Bank holder name(As per govt id)</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="bank_holder_name" value="{{ old('bank_holder_name') ? old('bank_holder_name') : ( isset($row->bank_holder_name) ? $row->bank_holder_name : '') }}" class="form-control @error('bank_holder_name') is-invalid @enderror " placeholder="Enter Bank holder name(As per govt id)"/>
                                @error('bank_holder_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">bank name</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="bank_name" value="{{ old('bank_name') ? old('bank_name') :( isset($row->bank_name) ? $row->bank_name : '') }}" class="form-control @error('bank_name') is-invalid @enderror " placeholder="Enter bank name"/>
                                @error('bank_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">branch address</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="branch_address" value="{{ old('branch_address') ? old('branch_address') :( isset($row->branch_address) ? $row->branch_address : '') }}" class="form-control @error('branch_address') is-invalid @enderror " placeholder="Enter branch address"/>
                                @error('branch_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">IFSC code</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="ifsc_code" value="{{ old('ifsc_code') ? old('ifsc_code') :( isset($row->ifsc_code) ? $row->ifsc_code : '') }}" class="form-control @error('ifsc_code') is-invalid @enderror " placeholder="Enter ifsc code"/>
                                @error('ifsc_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Cancelled Cheque Image </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                            	<div class="image-input image-input-outline" id="cancel_cheque_image" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->cancel_cheque_image) && !empty($row->cancel_cheque_image))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->cancel_cheque_image)}})"></div>
                            		@else
                            			<div class="image-input-wrapper cancel_cheque_image_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="cancel_cheque_image" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="cancel_cheque_image_remove"/>
									</label>

									@if(isset($row->cancel_cheque_image) && !empty($row->cancel_cheque_image))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

                                @error('cancel_cheque_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">pan card number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="pancard_number" value="{{ old('pancard_number') ? old('pancard_number') :( isset($row->pancard_number) ? $row->pancard_number : '') }}" class="form-control @error('pancard_number') is-invalid @enderror " placeholder="Enter pan card number"/>
                                @error('pancard_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">pan card image </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                            	<div class="image-input image-input-outline" id="pancard_image" style="background-image: url({{asset('media/users/blank.png')}})">

                            		@if(isset($row->pancard_image) && !empty($row->pancard_image))
										<div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->pancard_image)}})"></div>
                            		@else
                            			<div class="image-input-wrapper pancard_image_base64"></div>
                            		@endif

									<label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
										<i class="fa fa-pen icon-sm text-muted"></i>
										<input type="file" name="pancard_image" accept=".png, .jpg, .jpeg"/>
										<input type="hidden" name="pancard_image_remove"/>
									</label>

									@if(isset($row->pancard_image) && !empty($row->pancard_image))
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@else
										<span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
											<i class="ki ki-bold-close icon-xs text-muted"></i>
										</span>
                            		@endif
								</div>

                                @error('pancard_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">GST Applicable</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control @error('has_gst_applicable') is-invalid @enderror  selectpicker" name="has_gst_applicable" tabindex="null" onchange="hasGSTApplicable(this)">
                                    <option value="">Select</option>
                                    <option value="Yes" {{(old('has_gst_applicable') == 'Yes' || (!isset($row->has_gst_applicable) || empty($row->has_gst_applicable)) ) ? 'selected' : ( isset($row->has_gst_applicable) && $row->has_gst_applicable == 'Yes' ? 'selected' : '')}}>Yes</option>
                                    <option value="No" {{(old('has_gst_applicable') == 'No' || (!isset($row->has_gst_applicable) || empty($row->has_gst_applicable)) ) ? 'selected' : ( isset($row->has_gst_applicable) && $row->has_gst_applicable == 'No' ? 'selected' : '')}}>No</option>
                                </select>

                                @error('has_gst_applicable')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row  has-gst-applicable" style="display: {{ old('has_gst_applicable', $row->has_gst_applicable ?? 'No') == 'Yes' ? '' : 'none'; }}">
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">GST Number</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="gst_number" value="{{ old('gst_number') ? old('gst_number') :( isset($row->gst_number) ? $row->gst_number : '') }}" class="form-control @error('gst_number') is-invalid @enderror " placeholder="Enter GST Number"/>
                                @error('gst_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">gst certificate </label>
                        	<div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="file" name="gst_certificate_file"  class="form-control @error('gst_certificate_file') is-invalid @enderror " />
                                Uploaded File: 
                                @if($row->gst_certificate_file)
                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->gst_certificate_file) }}">{{$row->gst_certificate_file}}</a>
                            	@else
                            	N/A
                            	@endif
                               
                                @error('gst_certificate_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        
                        </div>
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
    
	// START cancel_cheque_image
    var cancel_cheque_image = new KTImageInput('cancel_cheque_image');

	cancel_cheque_image.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	cancel_cheque_image.on('change', function(imageInput) {
		
	});

	cancel_cheque_image.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END cancel_cheque_image

	// START pancard_image
    var pancard_image = new KTImageInput('pancard_image');

	pancard_image.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	pancard_image.on('change', function(imageInput) {
		
	});

	pancard_image.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END pancard_image

	// START gst_certificate_file
    var gst_certificate_file = new KTImageInput('gst_certificate_file');

	gst_certificate_file.on('cancel', function(imageInput) {
		swal.fire({
			title: 'Image successfully canceled !',
			type: 'success',
			buttonsStyling: false,
			confirmButtonText: 'Okay!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});

	gst_certificate_file.on('change', function(imageInput) {
		
	});

	gst_certificate_file.on('remove', function(imageInput) {
		swal.fire({
			title: 'Image successfully removed !',
			type: 'error',
			buttonsStyling: false,
			confirmButtonText: 'Got it!',
			confirmButtonClass: 'btn btn-primary font-weight-bold'
		});
	});
	// END gst_certificate_file

	function hasGSTApplicable(_this){

		if($(_this).val() == 'Yes'){
			$(".has-gst-applicable").show();
		} else {

			$(".has-gst-applicable").hide();
		}
	}

</script>
@endpush