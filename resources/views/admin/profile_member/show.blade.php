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
		                    <div class="col-12">
		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->name}}</label>
		                                
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
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DOB: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->dob}}</label>
		                                
		                            </div>
		                        </div>
		                        <div class="form-group row validated">
								    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Room Sharing:</label>
								    <div class="col-lg-9 col-md-9 col-sm-12">
								        <label class="col-form-label text-lg-left">
								            {{ $row->room_sharing == 1 ? 'Single Occupancy' : ($row->room_sharing == 2 ? 'Double Occupancy' : 'Triple Occupancy') }}
								        </label>
								    </div>
								</div>
		                    </div>		                    
		                </div>
		                <div class="col-12">
	                        <h4 class="card-label">For marketing and social media purpose</h4><hr>
	                    </div>
	                    <div class="row">
		                    
		                    <div class="col-12">

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Stage Name <i>(If Any)</i> : </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->stage_name}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Bio <i>(150 words only) </i> : </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->artist_bio}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Instagram Profile Link: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->instagram_url}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Facebook Profile Link: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->facebook_url}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Linkdin Profile Link: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->linkdin_url}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Twitter Profile Link: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->twitter_url}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Website <i>(If any)</i>: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->website}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Status: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ $row->status ? 'Active' : 'Inactive' }}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Created Date: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{ $row->created_at }}</label>                                     
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Updated Date: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{ $row->updated_at }}</label>                                     
                                    </div>
                                </div>

		                    </div>
		                    
		                </div>
		            </div>
		            <div class="card-footer">
		                <div class="row">
		                    <div class="col-lg-4"></div>
		                    <div class="col-lg-4 text-center">
		                        <a class="btn btn-primary" href="{{ route($moduleConfig['routes']['listRoute']) }}">Back</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

    </div>
</div>
@endsection