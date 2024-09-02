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
		                    <h3 class="card-label">Show Ticket Booking</h3>
		                </div>
		            </div>
		            
		            <div class="card-body">
		                <div class="row">		                    
		                    <div class="col-12">

		                    	<div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Festival Profile: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{($row->userProfile->festival->name . ' (' . $row->userProfile->project_year . ')') ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Travel Purpose: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->travelPurpose->name ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="{{ isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual') ? 'display:none;' : ''}}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Profile Member: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ implode(', ', $row->profileMember() ?? 'N/A') }}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
								    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name: </label>
								    <div class="col-lg-9 col-md-9 col-sm-12">
								        <label class="col-form-label text-lg-left">{{ implode(', ', $row->project() ?? 'N/A') }}</label>
								    </div>
								</div>

								<div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Title: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->salutation ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Traveller Name As Per Gov. ID: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->name}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Age: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->age}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->email}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->contact}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Date of Travel</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ \Carbon\Carbon::parse($row->onward_date)->format('d-M-Y') }}</label>		                                
		                            </div>
		                        </div>
		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Time</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->travel_preferred_time}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Origin City</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->onward_city}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Return Date for Travel</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ \Carbon\Carbon::parse($row->return_date)->format('d-M-Y') }}</label>		                                
		                            </div>
		                        </div>
		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Return Time for Travel</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->return_preffered_time}}</label>	
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return City</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->return_city}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
								    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">International / Domestic Travel: </label>
								    <div class="col-lg-9 col-md-9 col-sm-12">
								        <label class="col-form-label text-lg-left">{{ $row->international_or_domestic ?? 'N/A' }}</label>
								    </div>
								</div>

								<div class="form-group row validated" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic' ? 'display:none;' : '' }}">
								    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Have work visa for India</label>
								    <div class="col-lg-9 col-md-9 col-sm-12">
								        <label class="col-form-label text-lg-left">{{ $row->work_visa ?? 'N/A' }}</label>
								    </div>
								</div>

								<div class="form-group row validated" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic' ? 'display:none;' : '' }}">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Passport (Front Side Image): </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">
                                            @if(isset($row->front_side_passport) && !empty($row->front_side_passport))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/passports/'.$row->front_side_passport)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>		                                
		                            </div>		                            
		                        </div>

		                        <div class="form-group row validated" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic' ? 'display:none;' : '' }}">

		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Passport (Back Side Image): </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">
                                            @if(isset($row->back_side_passport) && !empty($row->back_side_passport))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/passports/'.$row->back_side_passport)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>		                                
		                            </div>		                            
		                        </div>

		                        <div class="form-group row validated" style="{{(isset($row->international_or_domestic) && $row->international_or_domestic == 'International') && (isset($row->work_visa) && $row->work_visa == 'Yes') ? '' : 'display:none;' }}">

		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Visa</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">
                                            @if(isset($row->upload_visa) && !empty($row->upload_visa))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/work_visas/'.$row->upload_visa)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>		                                
		                            </div>		                            
		                        </div>

		                        <div class="form-group row validated" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'International' ? 'display:none;' : '' }}">

		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Adhaar card or Driving License</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">
                                            @if(isset($row->adhaarcard_driving) && !empty($row->adhaarcard_driving))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/adhaarcard_drivings/'.$row->adhaarcard_driving)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>		                                
		                            </div>		                            
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pick Up Required</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ $row->pickup_required }}</label>		                                
		                            </div>
		                        </div>

		                        <!-- <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Cab Option</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">
		                            		@if($row->cab_option == 1)
                                                Transfer Only
                                            @elseif($row->cab_option == 2)
                                                Dedicated
                                            @endif
                                        </label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Number of Cabs</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ $row->number_of_cabs }}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Cab Date Range</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ $row->cab_date_range }}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks</label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{!! $row->artist_remarks !!}</label>		                                
		                            </div>
		                        </div>	 -->

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
		                        <a class="theme-btn mt-0 mb-0" href="{{ route('ticket.booking.list') }}">Back</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

    </div>
</div>
@endsection