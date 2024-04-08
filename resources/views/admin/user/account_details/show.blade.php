@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}} Banking Details</h3>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-9">
                                
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Full Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->name}}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Permanent Address: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->permanent_address}}</label>
                                    
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Account Number: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->account_number }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Bank holder name(As per govt id): </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->bank_holder_name }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Bank Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->bank_name }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Branch Address: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->branch_address }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">IFSC Code: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->ifsc_code }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Cancelled Cheque Image: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        
                                        <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">

                                            @if(isset($row->cancel_cheque_image) && !empty($row->cancel_cheque_image))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->cancel_cheque_image)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>

                                        <div class="">
                                            Uploaded File: 
                                            @if($row->cancel_cheque_image)
                                                <a target="_blank" href="{{ asset('uploads/users/'.$row->cancel_cheque_image) }}">{{$row->cancel_cheque_image}}</a>
                                            @else
                                            N/A
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Pan card Number: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->pancard_number }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Pan card Image: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        
                                        <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">

                                            @if(isset($row->pancard_image) && !empty($row->pancard_image))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->pancard_image)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>

                                        <div class="">
                                            Uploaded File: 
                                            @if($row->pancard_image)
                                                <a target="_blank" href="{{ asset('uploads/users/'.$row->pancard_image) }}">{{$row->pancard_image}}</a>
                                            @else
                                            N/A
                                            @endif
                                        </div>
                                    
                                    </div>
                                </div>


                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">GST Applicable: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->has_gst_applicable }}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">GST Number: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->gst_number }}</label>
                                        
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Gst Certificate: </label>
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