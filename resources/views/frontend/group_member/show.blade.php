@extends('layouts.frontend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
		    <div class="col-md-12">
		        
		        <div class="card card-custom gutter-b">
		            <div class="card-header">
		                <div class="card-title">
		                    <h3 class="card-label">Show Group Member</h3>
		                </div>
		            </div>
		            
		            <div class="card-body">
		                <div class="row">
		                    
		                    <div class="col-6">
		                        
		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">POC: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">

		                            	<label class="col-form-label text-lg-left">{{ isset($row->poc->name) ? $row->poc->name : 'N/A' }}</label>
		                            
		                            </div>
		                        </div>

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
		                        <a class="btn btn-primary" href="{{ route('group.member.list') }}">Back</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

    </div>
</div>
@endsection