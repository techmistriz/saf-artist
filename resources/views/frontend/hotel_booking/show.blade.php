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
		                    <h3 class="card-label">Show Hotel Booking</h3>
		                </div>
		            </div>
		            
		            <div class="card-body">
		                <div class="row">		                    
		                    <div class="col-12">

		                    	<div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">User Profile: </label>
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
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Accomodation Required: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->accomodation}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check In Date: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ \Carbon\Carbon::parse($row->check_in_date)->format('d-M-Y') }}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check Out Date: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ \Carbon\Carbon::parse($row->check_out_date)->format('d-M-Y') }}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Total Room Nights: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->total_room_nights}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->artist_remarks}}</label>
		                                
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
		                        <a class="theme-btn mt-0 mb-0" href="{{ route('hotel.booking.list') }}">Back</a>
		                    </div>
		                </div>
		            </div>
				</div>
			</div>
		</div>
    </div>
</div>
@endsection