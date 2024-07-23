@extends('layouts.frontend')

@section('content')

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container container-fluid">        

        <!--begin::Education-->
        <div class="d-flex flex-row">
            @include('frontend/includes/aside')
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">
		            <div class="card-header">
		                <div class="card-title">
		                	<h3 class="card-label">Show Artist Account Details</h3>
		                </div>
		            </div>
		            
		            <div class="card-body">
		                <div class="row">		                    
		                    <div class="col-12">

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name:</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->name ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Address: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ $row->permanent_address }}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pincode: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->pincode ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->country->country_name ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">State: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->state->state_name ?? 'N/A'}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->city->city_name ?? 'N/A'}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Account No: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->account_number ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Residency Name: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->residency ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'Domestic')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Iban Number: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->iban_number ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'Domestic')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Swift Code: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->swift_code ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'Domestic')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Corresponding Bank Details: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->corresponding_bank_details ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Bank holder name: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->bank_holder_name ?? 'N/A'}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Bank Name: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->bank_name ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Branch Address: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->branch_address ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">IFSC code: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->ifsc_code ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">PAN Card Number: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->pancard_number ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Cancel Cheque/Passbook: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">
                                            @if(isset($row->cancel_cheque_image) && !empty($row->cancel_cheque_image))
                                                <div class="image-input-wrapper"style="background-image: url({{asset('uploads/users/'.$row->cancel_cheque_image)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>		                                
		                            </div>
		                        </div>

		                    	<div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Is your pancard linked with adhar?: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-left">{{ $row->pancard_link_with_adhar ? 'Yes' : 'No' }}</label>		                            
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">PAN Card (Image): </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">
                                            @if(isset($row->pancard_image) && !empty($row->pancard_image))
                                                <div class="image-input-wrapper"style="background-image: url({{asset('uploads/users/'.$row->pancard_image)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{( isset($row->residency) && $row->residency == 'International')  ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">GST Applicable: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->has_gst_applicable ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="display: {{ old('has_gst_applicable', $row->has_gst_applicable ?? 'No') == 'Yes' ? '' : 'none'; }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">GST Number: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->gst_number ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="display: {{ old('has_gst_applicable', $row->has_gst_applicable ?? 'No') == 'Yes' ? '' : 'none'; }}">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">GST Certificate:</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <div class="">
                                            Uploaded File: 
                                            @if($row->gst_certificate_file)
                                                <a target="_blank" href="{{ asset('uploads/users/'.$row->gst_certificate_file) }}">{{$row->gst_certificate_file}}</a>
                                            @else
                                            N/A
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Status: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-left">{{ $row->status ? 'Active' : 'Inactive' }}</label>		                            
		                            </div>
		                        </div>

		                    </div>
		                </div>
		            </div>

		            <div class="card-footer">
		                <div class="row">
		                    <div class="col-lg-4"></div>
		                    <div class="col-lg-4 text-center">
		                        <a class="theme-btn mt-0 mb-0" href="{{ route('user.account.details.index') }}">Back</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

    </div>
</div>
@endsection