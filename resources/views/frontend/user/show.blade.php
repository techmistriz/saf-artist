@extends('layouts.frontend')

@section('content')
<style type="text/css">
	.style .pagination{
		font-size: 15px;
	}

	.page-link{
		color: #181c32;
	}

	.page-item.active .page-link {
    	z-index: 3;
    	color: #fff;
    	background-color: #981e3d;
    	border-color: #981e3d;
	}

	.page-link:hover {
    	z-index: 2;
    	color: #981e3d;
    	text-decoration: none;
    	background-color: #ebedf3;
    	border-color: #e4e6ef;
	}
	#memberList{
		border-top: 1px solid #ebedf3;
	}

</style>

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
		                	@if(isset(Auth::user()->frontendRole->name) && !empty(Auth::user()->frontendRole->name))
		                        <h3 class="card-label">Show {{ Auth::user()->frontendRole->name }} Details</h3>
		                    @endif
		                </div>
		                <div class="card-toolbar" style="{{isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual') ? 'display:none;' : '' }}">
    						<a href="#memberList" class="btn font-weight-bold ml-2" id="button">Member List</a>
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
		                            	<label class="col-form-label text-lg-left">{{Auth::user()->frontendRole->name ?? 'N/A'}}</label>
		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Category: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->category->name ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Curators Name: </label>
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

		                        <div class="form-group row validated" >
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

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Company/Collective: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->company_collective ?? 'N/A'}}</label>
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Troup Size: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->troup_size ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
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

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Have you been associated with Serendipity Arts in the past ?: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->has_serendipity_arts ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Link with videos of your work: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{$row->other_link ?? 'N/A'}}</label>		                                
		                            </div>
		                        </div>

		                        <div class="form-group row validated" style="display: {{ old('has_serendipity_arts') == 'Yes' || (isset($row->has_serendipity_arts) && $row->has_serendipity_arts == 'Yes') ? '' : 'none' }};">
		                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Year: </label>
		                            <div class="col-lg-9 col-md-9 col-sm-12">
		                            	<label class="col-form-label text-lg-left">{{ implode(', ', $row->year) }}</label>		                                
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

		            <div class="card-header" id="memberList" style="{{isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual') ? 'display:none;' : '' }}">
                        <div class="card-title">
                            <h3 class="card-label">Members Details</h3>
                        </div>
                        <div class="card-toolbar">
    						<a href="{{ route('profile.member.create', ['profile_id' => $row->id]) }}" class="btn font-weight-bold ml-2" id="button">Add Member</a>
    					</div>
                    </div>

                    <div class="card-body" style="{{isset(Auth::user()->frontendRole->name) && (Auth::user()->frontendRole->name == 'Individual') ? 'display:none;' : '' }}">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>

                            </thead>
                            <tbody>
                                @forelse($members as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->contact }}</td>
                                        <td>
							                <span class="overflow-visible position-relative" style="width: 125px;" data-id="{{ $value->id }}">
											    <a href="{{ route('profile.member.show', $value->id) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="Show details">
											        <i class="flaticon-eye"></i>
											    </a>
											    <a href="{{ route('profile.member.edit', $value->id) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit member details">
											        <i class="flaticon2-pen"></i>
											    </a>
											    <a href="{{ route('profile.member.delete', $value->id) }}" class="btn btn-sm btn-clean btn-icon mr-2" title="Delete member details">
											        <i class="flaticon2-trash"></i>
											    </a>
											</span>
							            </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-danger">No Record Found</td>
                                    </tr>

                                @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end style">
						    {{ $members->links('pagination::bootstrap-4') }}
						</div>


                    </div>

		            <div class="card-footer">
		                <div class="row">
		                    <div class="col-lg-4"></div>
		                    <div class="col-lg-4 text-center">
		                        <a class="theme-btn mt-0 mb-0" href="{{ route('dashboard') }}">Back</a>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>

		</div>

    </div>
</div>
@endsection