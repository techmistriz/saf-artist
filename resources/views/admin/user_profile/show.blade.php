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
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Year: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->project_year ?? 'N/A'}}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Festival: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->festival->name ?? 'N/A'}}</label>
                                        
                                    </div>
                                </div>

                                <!-- <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->project->name ?? 'N/A'}}</label>
                                        
                                    </div>
                                </div> -->

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">User Type: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->user->frontendRole->name ?? 'N/A'}}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Category: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->category->name ?? 'N/A'}}</label>                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name Curators: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->curator->name ?? 'N/A'}}</label>                                      
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Type: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->artistType->name ?? 'N/A'}}</label>                                      
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->name ?? 'N/A'}}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->email ?? 'N/A'}}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">+{{$row->country_code ?? ''}} {{$row->contact ?? 'N/A'}}</label>                                     
                                    </div>
                                </div>

                                <div class="form-group row validated" style="{{ isset($row->user->frontendRole->name) && ($row->user->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DOB: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->dob ?? 'N/A'}}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Address: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->permanent_address ?? 'N/A'}}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->PACountry->country_name ?? 'N/A'}}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">State: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->PAState->state_name ?? 'N/A'}}</label>                                       
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->PACity->city_name ?? 'N/A'}}</label>                                     
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pincode: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->pa_pincode ?? 'N/A'}}</label>                                        
                                    </div>
                                </div>

                                <div class="form-group row validated" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Company/Collective: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->company_collective ?? 'N/A'}}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated" style="{{ isset($row->user->frontendRole->name) && ($row->user->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Troup Size: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->troup_size ?? 'N/A'}}</label>                                        
                                    </div>
                                </div>

                                <div class="form-group row validated" style="{{ isset($row->user->frontendRole->name) && ($row->user->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Payment of the Troup: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->payment_troup ?? 'N/A'}}</label>                                     
                                    </div>
                                </div>
                            </div>                          
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <h4 class="card-label">For marketing and social media purpose</h4><hr>
                            </div>
                            <div class="col-12">

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Stage Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->stage_name ?? 'N/A'}}</label>                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Bio: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->artist_bio ?? 'N/A'}}</label>                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Instagram Profile Link: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->instagram_url ?? 'N/A'}}</label>                                     
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Facebook Profile Link: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->facebook_url ?? 'N/A'}}</label>                                      
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Linkdin Profile Link: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->linkdin_url ?? 'N/A'}}</label>                                       
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Twitter Profile Link: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->twitter_url ?? 'N/A'}}</label>                                       
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Website: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-left">{{$row->website ?? 'N/A'}}</label>                                       
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-12">
                                <h5 class="card-label">Please upload 3 high resolutions images of your practice (for use on social media and print collaterals)</h5><hr>
                            </div>
                            <div class="col-12">
                                <div class="form-group row validated">
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank.png')}})">
                                            @if(isset($row->practice_image_1) && !empty($row->practice_image_1))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->practice_image_1)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <label class="col-form-label text-lg-left">{{$row->practice_credit_1 ?? 'N/A'}}</label>
                                        </div>                                      
                                    </div>
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank.png')}})">
                                            @if(isset($row->practice_image_2) && !empty($row->practice_image_2))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->practice_image_2)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <label class="col-form-label text-lg-left">{{$row->practice_credit_2 ?? 'N/A'}}</label>
                                        </div>                                      
                                    </div>
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank.png')}})">
                                            @if(isset($row->practice_image_3) && !empty($row->practice_image_3))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->practice_image_3)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <label class="col-form-label text-lg-left">{{$row->practice_credit_3 ?? 'N/A'}}</label>
                                        </div>                                      
                                    </div>
                                </div>

                            </div>
                                        
                            <div class="col-12">
                                <h5 class="card-label">Please upload 2 high resolution profile images (For your festival ID and promotion)</h5><hr>
                            </div>

                            <div class="col-12">
                                <div class="form-group row validated">
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank.png')}})">
                                            @if(isset($row->profile_image_1) && !empty($row->profile_image_1))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->profile_image_1)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <label class="col-form-label text-lg-left">{{$row->profile_credit_1 ?? 'N/A'}}</label>
                                        </div>                                      
                                    </div>
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <div class="image-input image-input-outline" style="background-image: url({{asset('media/users/blank.png')}})">
                                            @if(isset($row->profile_image_2) && !empty($row->profile_image_2))
                                                <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->profile_image_2)}})"></div>
                                            @else
                                                <div class="image-input-wrapper"></div>
                                            @endif
                                        </div>
                                        <div>
                                            <label class="col-form-label text-lg-left">{{$row->profile_credit_2 ?? 'N/A'}}</label>
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