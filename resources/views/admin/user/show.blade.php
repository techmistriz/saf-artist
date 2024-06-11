@extends('layouts.backend')

@section('content')

<div class="d-flex flex-column-fluid">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            @if(isset($row->frontendRole->name) && !empty($row->frontendRole->name))
                                <h3 class="card-label">Show {{$row->frontendRole->name}} Details</h3>
                            @else
                                <h3 class="card-label">Show {{$moduleConfig['moduleTitle']}}</h3>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>User Type</th>
                                                <td colspan="4">{{ $row->frontendRole->name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Category</th>
                                                <td colspan="4">{{ $row->category->name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Artist Type</th>
                                                <td colspan="4">{{ $row->artistType->name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Name of Curators</th>
                                                <td colspan="4">{{ $row->curator_name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr>
                                                <th>Project Name</th>
                                                <td colspan="4">{{ $row->project->name ?? 'N/A' }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <th>Full Name</th>
                                                <td colspan="4">{{$row->name}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>DOB</th>
                                                <td colspan="4">{{$row->dob}}</td>
                                            </tr>

                                            <tr>
                                                <th>Contact</th>
                                                <td colspan="4">{{$row->contact}}</td>
                                            </tr>

                                            <tr>
                                                <th>Email</th>
                                                <td colspan="4">{{$row->email}}</td>
                                            </tr>

                                            <tr>
                                                <th>Address</th>
                                                <td colspan="4">{{$row->permanent_address}}</td>
                                            </tr>

                                            <tr>
                                                <th>Country</th>
                                                <td colspan="4">{{$row->PACountry->country_name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr style="{{ isset($row->PACountry->country_name) && ($row->PACountry->country_name == 'Other') ? 'display:none;' :''}}">
                                                <th>State</th>
                                                <td colspan="4">{{$row->PAState->state_name ?? 'N/A' }}</td>
                                            </tr>                                            

                                            <tr style="{{ isset($row->PACountry->country_name) && ($row->PACountry->country_name == 'Other') ? 'display:none;' :''}}">
                                                <th>City</th>
                                                <td colspan="4">{{$row->PACity->city_name ?? 'N/A' }}</td>
                                            </tr>

                                            <tr style="{{ isset($row->PACountry->country_name) && ($row->PACountry->country_name == 'Other') ? 'display:none;' :''}}">
                                                <th>Pincode</th>
                                                <td colspan="4">{{$row->pa_pincode}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->PACountry->country_name) && ($row->PACountry->country_name == 'India') ? 'display:none;' :''}}">
                                                <th>Country - Other</th>
                                                <td colspan="4">{{$row->pa_country_other ?? 'N/A' }}</td>
                                            </tr>                                            

                                            <!-- <tr style="{{ isset($row->PACountry->country_name) && ($row->PACountry->country_name == 'India') ? 'display:none;' :''}}">
                                                <th>State - Other </th>
                                                <td colspan="4">{{$row->pa_state_other ?? 'N/A' }}</td>
                                            </tr>

                                            <tr style="{{ isset($row->PACountry->country_name) && ($row->PACountry->country_name == 'India') ? 'display:none;' :''}}">
                                                <th>City - Other</th>
                                                <td colspan="4">{{$row->pa_city_other ?? 'N/A' }}</td>
                                            </tr>

                                            <tr style="{{ isset($row->PACountry->country_name) && ($row->PACountry->country_name == 'India') ? 'display:none;' :''}}">
                                                <th>Pincode - Other</th>
                                                <td colspan="4">{{$row->ca_pincode}}</td>
                                            </tr> -->

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                                                <th>Company/Collective (If Applicable)</th>
                                                <td colspan="4">{{$row->company_collective}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Stage Name (If Any)</th>
                                                <td colspan="4">{{$row->stage_name}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Artist Bio</th>
                                                <td colspan="4">{!! $row->artist_bio !!}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Instagram URL</th>
                                                <td colspan="4">{{$row->instagram_url}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Facebook URL</th>
                                                <td colspan="4">{{$row->facebook_url}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Linkdin URL</th>
                                                <td colspan="4">{{$row->linkdin_url}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Twitter URL</th>
                                                <td colspan="4">{{$row->twitter_url}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Website</th>
                                                <td colspan="4">{{$row->website}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Please upload 3 high resolutions images of your practice (for use on social media and print collaterals)</th>
                                                <td>
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
                                                </td>
                                                <td>
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
                                                </td>
                                                <td>
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
                                                </td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Please upload 2 high resolution profile images (For your festival ID and promotion)</th>
                                                <td>
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
                                                </td>
                                                <td colspan="3">
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
                                                </td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Have you been associated with Serendipity Arts in the past ?</th>
                                                <td colspan="4">{{$row->has_serendipity_arts}}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Year</th>
                                                <td colspan="4">{{ implode(', ', $row->year) }}</td>
                                            </tr>

                                            <tr style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                                <th>Link with videos of your work <i>(If any)</i></th>
                                                <td colspan="4">{{ $row->other_link }}</td>
                                            </tr>

                                            <tr>
                                                <th>Status</th>
                                                <td colspan="4">{{ $row->status ? 'Active' : 'Inactive' }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
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