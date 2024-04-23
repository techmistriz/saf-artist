@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}} Account Details</h3>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="col-9">
                                
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Are you registring for group: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->reg_for_group }}</label>
                                        
                                    </div>
                                </div>
                                
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Category: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->category->name ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Artist Type: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->artistType->name ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Name of Curators: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->curator_name ?? 'N/A' }}</label>
                                    </div>
                                </div>
                                
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Project Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->project->name ?? 'N/A' }}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Full Name: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{$row->name}}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">DOB: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->dob }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Contact: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->contact }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Email: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->email }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Address: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->permanent_address }}</label>
                                    
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Country: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->PACountry->country_name ?? 'N/A' }}</label>
                                        
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Country - Other: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->pa_country_other ?? 'N/A' }}</label>
                                        
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">State: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->PAState->state_name ?? 'N/A' }}</label>
                                        
                                    </div>
                                </div>  

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">City: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->PACity->city_name ?? 'N/A' }}</label>
                                        
                                    </div>
                                </div>  

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">City - Other: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->pa_city_other ?? 'N/A' }}</label>
                                        
                                    </div>
                                </div> 

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Pincode: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->pa_pincode }}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Pincode: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->ca_pincode }}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Stage Name (If Any): </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{{ $row->stage_name }}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Artist Bio: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">

                                        <label class="col-form-label text-lg-right">{!! $row->artist_bio !!}</label>
                                        
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Instagram URL: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->instagram_url }}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Facebook URL: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->facebook_url }}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Linkdin URL: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->linkdin_url }}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Twitter URL: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->twitter_url }}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Website <i>(If any)</i> : </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->website }}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Please upload 3 high resolutions images of your practice (for use on social media and print collaterals):</label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
                                                    @if(isset($row->practice_image_1) && !empty($row->practice_image_1))
                                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->practice_image_1)}})"></div>
                                                    @else
                                                        <div class="image-input-wrapper"></div>
                                                    @endif
                                                </div>
                                                <div class="">
                                                    Uploaded File: 
                                                    @if($row->practice_image_1)
                                                        <a target="_blank" href="{{ asset('uploads/users/'.$row->practice_image_1) }}">{{$row->practice_image_1}}</a>
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
                                                    @if(isset($row->practice_image_2) && !empty($row->practice_image_2))
                                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->practice_image_2)}})"></div>
                                                    @else
                                                        <div class="image-input-wrapper"></div>
                                                    @endif
                                                </div>
                                                <div class="">
                                                    Uploaded File: 
                                                    @if($row->practice_image_2)
                                                        <a target="_blank" href="{{ asset('uploads/users/'.$row->practice_image_2) }}">{{$row->practice_image_2}}</a>
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
                                                    @if(isset($row->practice_image_3) && !empty($row->practice_image_3))
                                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->practice_image_3)}})"></div>
                                                    @else
                                                        <div class="image-input-wrapper"></div>
                                                    @endif
                                                </div>
                                                <div class="">
                                                    Uploaded File: 
                                                    @if($row->practice_image_3)
                                                        <a target="_blank" href="{{ asset('uploads/users/'.$row->practice_image_3) }}">{{$row->practice_image_3}}</a>
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Please upload 2 high resolution profile images (For your festival ID and promotion): </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
                                                    @if(isset($row->profile_image_1) && !empty($row->profile_image_1))
                                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->profile_image_1)}})"></div>
                                                    @else
                                                        <div class="image-input-wrapper"></div>
                                                    @endif
                                                </div>
                                                <div class="">
                                                    Uploaded File: 
                                                    @if($row->profile_image_1)
                                                        <a target="_blank" href="{{ asset('uploads/users/'.$row->profile_image_1) }}">{{$row->profile_image_1}}</a>
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="image-input image-input-outline" id="program_image_1" style="background-image: url({{asset('media/users/blank.png')}})">
                                                    @if(isset($row->profile_image_2) && !empty($row->profile_image_2))
                                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/users/'.$row->profile_image_2)}})"></div>
                                                    @else
                                                        <div class="image-input-wrapper"></div>
                                                    @endif
                                                </div>
                                                <div class="">
                                                    Uploaded File: 
                                                    @if($row->profile_image_2)
                                                        <a target="_blank" href="{{ asset('uploads/users/'.$row->profile_image_2) }}">{{$row->profile_image_2}}</a>
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Have you been associated with Serendipity Arts in the past ?: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->has_serendipity_arts }}</label>
                                    </div>
                                </div>

                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Year: </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ implode(', ', $row->year) }}</label>
                                    </div>
                                </div>
                                
                                <div class="form-group row validated">
                                    <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Link with videos of your work <i>(If any)</i> : </label>
                                    <div class="col-lg-9 col-md-9 col-sm-12">
                                        <label class="col-form-label text-lg-right">{{ $row->other_link }}</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="card-header" style="{{isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' : '' }}">
                        <div class="card-title">
                            <h3 class="card-label">Members Details</h3>
                        </div>
                    </div>

                    <div class="card-body" style="{{isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' : '' }}">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($members as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->contact }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-danger">No Record Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <!--end: Datatable-->
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