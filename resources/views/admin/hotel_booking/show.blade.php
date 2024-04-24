@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="row">
		    <div class="col-md-12">		        
		        <div class="card card-custom gutter-b">
		            <div class="card-header">
		                <div class="card-title">
		                    <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}}</h3>
		                </div>
		            </div>		            
		           <div class="card-body">
		                <div class="row">
		                    
		                    <div class="col-6">

		                    	<div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Member: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->member->name ?? ''}}</label>
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
		                            	<label class="col-form-label text-lg-left">{{$row->check_in_date}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check Out Date: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->check_out_date}}</label>
		                                
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
		                        <a class="btn btn-primary" href="{{route('admin.user.index')}}">Back</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

    </div>
</div>
@endsection