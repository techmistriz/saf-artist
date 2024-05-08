@extends('layouts.frontend')
@section('content')
<style type="text/css">
	.image-input {
	    margin-right: 10px;
	}
	.image-input .image-input-wrapper {
	    width: 85px;
	    height: 85px;
	}
	.bootstrap-select>.dropdown-toggle.btn-light, .bootstrap-select>.dropdown-toggle.btn-secondary {
	    height: calc(1.5em + 1.65rem + 2px);
	    padding: 0.825rem 1.42rem;
	    font-size: 1.08rem;
	    line-height: 1.5;
	    border-radius: 0.42rem;
        background-color: #f3f6f9 !important;
    	border-color: #f3f6f9 !important;
	}
</style>
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Education-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            @include('frontend/includes/aside')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">

                	<form action="{{ route('update.account.details') }}" method="POST" enctype="multipart/form-data">
			            <input type="hidden" name="_method" value="PUT">
			            <input type="hidden" name="id" value="{{$row->id}}">
			            {{ csrf_field() }}
	                    <!--Begin::Header-->
	                    <div class="card-header">
			                @include('flash::message')
			                
			                <div class="card-title">
			                    <h3 class="card-label">Artist Banking Details</h3>
			                </div>

			            </div>
	                    <!--end::Header-->
	                    <!--Begin::Body-->
	                    <div class="card-body">
			                <div class="row">
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Full Name </label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="name" value="{{ $user->name }}" class="form-control form-control-lg form-control-solid @error('name') is-invalid @enderror " placeholder="Enter Name"/>
			                                @error('name')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            </div>
			                        </div>
			                    </div>
			                    
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Address</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <textarea class="form-control form-control-lg form-control-solid @error('permanent_address') is-invalid @enderror  no-summernote-editor" name="permanent_address" id="permanent_address" placeholder="Enter Address" require>{{ $user->permanent_address. ', '.$user->PACountry->country_name. ', '.$user->pa_pincode }}</textarea>
			                                @error('permanent_address')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Pincode</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="pincode" value="{{ old('pincode', $row->pincode ?? '') }}" class="form-control form-control-lg form-control-solid @error('pincode') is-invalid @enderror " placeholder="Enter Pincode" required/>
			                                @error('pincode')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            </div>
			                        </div>
			                    </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control selectpicker" name="country_id" tabindex="null" onchange="getState()">
			                                    <option value="" data-slug="">Select Country</option>
			                                    @if($countries->count())
			                                        @foreach($countries as $value)
			                                          <option {{ (old('country_id') ?? optional($row)->country_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->country_name}}</option>
			                                        @endforeach
			                                    @endif
			                                </select>
			                                @error('country_id')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            </div>
			                        </div> 
                                </div>		

			                    <div class="col-12">
                                    <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">State</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control selectpicker" name="state_id" tabindex="null" onchange="getCity()">
			                                    <option value="" data-slug="">Select State</option>
			                                   
			                                </select>
			                                @error('state_id')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            </div>
			                        </div> 
                                </div> 	
                                
                                <div class="col-12 state-wrapper">
                                    <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control selectpicker" name="city_id" tabindex="null">
			                                    <option value="" data-slug="">Select City</option>
			                                    
			                                </select>
			                                @error('city_id')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            </div>
			                        </div> 
                                </div>                   
			                    
			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">account number</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="account_number" oninput="this.value=this.value.replace(/[^0-9]/, '')" minlength="10" maxlength="20" value="{{ old('account_number') ? old('account_number') :( isset($row->account_number) ? $row->account_number : '') }}" class="form-control form-control-lg form-control-solid @error('account_number') is-invalid @enderror " placeholder="Enter account number"/>
			                                @error('account_number')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Re-enter account number</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="confirm_account_number" oninput="this.value=this.value.replace(/[^0-9]/, '')" minlength="10" maxlength="20" value="{{ old('confirm_account_number') ? old('confirm_account_number') :( isset($row->confirm_account_number) ? $row->confirm_account_number : '') }}" class="form-control form-control-lg form-control-solid @error('confirm_account_number') is-invalid @enderror " placeholder="Enter confirm account number"/>
			                                @error('confirm_account_number')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Bank holder name (As per bank records)</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="bank_holder_name" value="{{ old('bank_holder_name') ? old('bank_holder_name') :( isset($row->bank_holder_name) ? $row->bank_holder_name : '') }}" class="form-control form-control-lg form-control-solid @error('bank_holder_name') is-invalid @enderror " placeholder="Enter Bank Holder name (As per bank records)"/>
			                                @error('bank_holder_name')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">bank name</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="bank_name" value="{{ old('bank_name') ? old('bank_name') :( isset($row->bank_name) ? $row->bank_name : '') }}" class="form-control form-control-lg form-control-solid @error('bank_name') is-invalid @enderror " placeholder="Enter bank name"/>
			                                @error('bank_name')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">branch address</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="branch_address" value="{{ old('branch_address') ? old('branch_address') :( isset($row->branch_address) ? $row->branch_address : '') }}" class="form-control form-control-lg form-control-solid @error('branch_address') is-invalid @enderror " placeholder="Enter branch address"/>
			                                @error('branch_address')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">IFSC code</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="ifsc_code" value="{{ old('ifsc_code') ? old('ifsc_code') :( isset($row->ifsc_code) ? $row->ifsc_code : '') }}" class="form-control form-control-lg form-control-solid @error('ifsc_code') is-invalid @enderror " placeholder="Enter ifsc code"/>
			                                @error('ifsc_code')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">

			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Cancelled Cheque (Image optional)</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                
			                            	<input type="file" name="cancel_cheque_image"  class="form-control form-control-lg form-control-solid @error('cancel_cheque_image') is-invalid @enderror " />

			                            	Uploaded File: 
			                                @if($row->cancel_cheque_image)
			                                	<a target="_blank" href="{{ asset('uploads/users/'.$row->cancel_cheque_image) }}">{{$row->cancel_cheque_image}}</a>
			                            	@else
			                            	N/A
			                            	@endif

			                                @error('cancel_cheque_image')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">PAN Card Number</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="pancard_number" value="{{ old('pancard_number') ? old('pancard_number') :( isset($row->pancard_number) ? $row->pancard_number : '') }}" class="form-control form-control-lg form-control-solid @error('pancard_number') is-invalid @enderror " placeholder="Enter pancard number"/>
			                                @error('pancard_number')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            </div>
			                        </div>
			                    </div>

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Is your pancard linked with adhar?</label>
			                            <div class="col-form-label col-lg-9 col-md-9 col-sm-12">
			                            	<div class="checkbox-inline">
										        <label class="checkbox">
										            <input type="checkbox" name="pancard_link_with_adhar" value="1" {{(old('pancard_link_with_adhar', $row->pancard_link_with_adhar ?? '') == '1') ? 'checked' : '' }} required="" />
										            <span></span>
										        </label>
										    </div>

				                            @error('pancard_link_with_adhar')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
				                        </div>
			                        </div>
			                    </div>

			                    <div class="col-12">

			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">PAN Card (Image) </label>
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

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">GST Applicable</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <select class="form-control form-control-lg form-control-solid @error('has_gst_applicable') is-invalid @enderror  selectpicker" name="has_gst_applicable" tabindex="null" onchange="hasGSTApplicable(this)">
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

			                    <div class="col-12 has-gst-applicable" style="display: {{ old('has_gst_applicable', $row->has_gst_applicable ?? 'No') == 'Yes' ? '' : 'none'; }}">

			                    	<div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">GST Number</label>
			                            <div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="text" name="gst_number" value="{{ old('gst_number') ? old('gst_number') :( isset($row->gst_number) ? $row->gst_number : '') }}" class="form-control form-control-lg form-control-solid @error('gst_number') is-invalid @enderror " placeholder="Enter GST Number"/>
			                                @error('gst_number')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
			                            
			                            </div>
			                        </div>

			                        <div class="form-group row validated">
			                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">gst certificate </label>
			                        	<div class="col-lg-9 col-md-9 col-sm-12">
			                                <input type="file" name="gst_certificate_file"  class="form-control form-control-lg form-control-solid @error('gst_certificate_file') is-invalid @enderror " />
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

			                    <div class="col-12">
			                        <div class="form-group row validated">
			                            <div class="col-lg-3 col-md-3 col-sm-12">
			                                &nbsp;
			                            </div>
			                            <div class="col-form-label col-lg-9 col-md-9 col-sm-12">
			                            	<div class="checkbox-inline">
										        <label class="checkbox">
										            <input type="checkbox" name="terms" value="1" required="" />
										            <span></span>
										            {{ env('FORM_CONSENT', 'I Accept Terms & Conditions') }}
										        </label>
										    </div>

				                            @error('terms')
			                                    <div class="invalid-feedback">{{ $message }}</div>
			                                @enderror
				                        </div>
			                        </div>
			                    </div>
			                    
			                </div>
			            </div>
	                    <!--end::Body-->

	                    <div class="card-footer">
			                <div class="row">
			                	@if(\Auth::user()->is_freeze == 0)
			                    <div class="col-lg-4"></div>
			                    <div class="col-lg-4 text-center">
			                        <button type="submit" class="theme-btn mt-0 mb-0">Update</button>
			                    </div>
			                    @else
			                    	<div class="col-lg-12">
			                    		<p class="text-center text-danger small italic">Your account has been freeze by admin hence you are not able to update any of details.</p>
			                    	</div>
			                    @endif
			                </div>
			            </div>
		            </form>

                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    
    //START pancard_image
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
	//END pancard_image

	function hasGSTApplicable(_this){

		if($(_this).val() == 'Yes'){
			$(".has-gst-applicable").show();
		} else {

			$(".has-gst-applicable").hide();
		}
	}

	function getState() {
        //console.log('getState Called');
        var country_id = $('select[name=country_id]').val();
        //console.log('country_id', country_id);
        if (country_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('states') }}/" + country_id,
                dataType: 'json',
                success: function (response) {
                    if (response && response.status) {
                        var options = '<option value="">Select State</option>';
                        if (response.data.length) {

                            var selectedId = '{{ $row->state_id ?? 0 }}';

                            for (var i = 0; i < response.data.length; i++) {
                                var _selected = '';

                                if (selectedId == response.data[i].id) {
                                    _selected = 'selected';
                                }

                                options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].state_name + '</option>';
                            }

                            $("select[name='state_id']").html(options);
                            $("select[name='state_id']").selectpicker('refresh');
                            getCity();
                        }
                    }
                }
            });

        } else {

            $("select[name='state_id']").html('<option value="">Select State</option>');
            $("select[name='state_id']").selectpicker('refresh');
        }
    }

    function getCity() {

        var state_id = $('select[name=state_id]').val();

        if (state_id) {
            $.ajax({
                type: "GET",
                url: "{{ url('cities') }}/" + state_id,
                datatype: 'json',
                success: function (response) {
                    if (response && response.status) {
                        var options = '<option value="">Select City</option>';
                        if (response.data.length) {

                            var selectedId = '{{ $row->city_id ?? 0 }}';

                            for (var i = 0; i < response.data.length; i++) {
                                var _selected = '';

                                if (selectedId == response.data[i].id) {
                                    _selected = 'selected';
                                }

                                options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].city_name + '</option>';
                            }

                            $("select[name='city_id']").html(options);
                            $("select[name='city_id']").selectpicker('refresh');
                        }
                    }
                }
            });

        } else {
            
            $("select[name='city_id']").html('<option value="">Select City</option>');
            $("select[name='city_id']").selectpicker('refresh');
        }
    }


    $(document).ready(function(){
        
        getState();
        
    });


    

</script>
@endpush