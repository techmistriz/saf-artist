@include('flash::message')
<style type="text/css">
	.radio {
		display: -webkit-box;
	}

	.image-input {
	    margin-right: 10px;
	}

</style>
<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    @if(isset($row->frontendRole->name) && !empty($row->frontendRole->name))
                        <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$row->frontendRole->name}}</h3>
                    @else
                        <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}}</h3>
                    @endif
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">

                	<div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">User Type</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-custom selectpicker" name="frontend_role_id" tabindex="null" onchange="groupFieldShow()">
                                    <option value="">Select Role</option>
                                    @if($frontendRoles->count())
                                        @foreach($frontendRoles as $value)
                                            <option {{ (old('frontend_role_id') ?? optional($row)->frontend_role_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('frontend_role_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Category </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select name="category_id" id="category_id" class="form-control form-control-lg form-control-custom selectpicker @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>

                                    @if($categories->count())
                                        @foreach($categories as $value)
                                            <option value="{{$value->id}}" {{ old('category_id', $row->category_id ?? 0) == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Type</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select name="artist_type_id" id="artist_type_id" class="form-control form-control-lg form-control-custom selectpicker @error('artist_type_id') is-invalid @enderror">
                                    <option value="">Select Artist Type</option>

                                    @if($artistTypes->count())
                                        @foreach($artistTypes as $value)
                                            <option value="{{$value->id}}" {{ old('artist_type_id', $row->artist_type_id ?? 0) == $value->id ? 'selected' : '' }}>{{$value->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('artist_type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Name of Curators </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select name="curator_name" id="curator_name" class="form-control form-control-lg form-control-custom selectpicker @error('curator_name') is-invalid @enderror">
                                    <option value="">Select Curator</option>

                                    @if($curators->count())
                                        @foreach($curators as $value)
                                            <option value="{{$value->name}}" {{ old('curator_name', $row->curator_name ?? '') == $value->name ? 'selected' : '' }}>{{$value->name}}</option>
                                        @endforeach
                                    @endif

                                </select>
                                @error('curator_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="project_id" tabindex="null" >
                                    <option value="">Select</option>
                                    @if($projects->count())
                                        @foreach($projects as $value)

                                           <option {{ old('project_id', $row->project_id ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Full Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name" value="{{ old('name', $row->name ?? '') }}" class="form-control" placeholder="Enter Full Name"/>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6" id="dob" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DOB </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                            	<div class="input-group date">
									<input type="text" name="dob" value="{{ old('dob') ? old('dob') : ( isset($row->dob) ? $row->dob : '') }}" class="form-control kt_datepicker" placeholder="Enter DOB" autocomplete="new dob" readonly />

									@error('vip_seats')
	                                    <div class="invalid-feedback">{{ $message }}</div>
	                                @enderror

									<div class="input-group-append">
										<span class="input-group-text">
											<i class="la la-calendar-check-o"></i>
										</span>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" oninput="this.value=this.value.replace(/[^0-9]/, '')" name="contact" value="{{ old('contact') ? old('contact') :( isset($row->contact) ? $row->contact : '') }}" class="form-control"  minlength="10" maxlength="10"  placeholder="Enter Contact"/>
                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="email" value="{{ old('email') ? old('email') : ( isset($row->email) ? $row->email : '') }}" class="form-control" placeholder="Enter Email"/>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Address </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control no-summernote-editor" name="permanent_address" id="permanent_address" placeholder="Enter Address" require>{{ old('permanent_address') ? old('permanent_address') : ( isset($row->permanent_address) ? $row->permanent_address : '') }}</textarea>
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
			                	
                	<div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country </label>
                            	<div class="col-lg-9 col-md-9 col-sm-12">
                                <select name="pa_country_id" id="pa_country_id" class="form-control form-control-lg form-control-custom selectpicker @error('pa_country_id') is-invalid @enderror" onchange="getStates(this, 'pa_country_id', 'pa_state_id', 'State'); checkOtherCountry(this)">
			                    	<option value="">Select Country</option>

			                    	@if($countries->count())
		                                @foreach($countries as $country)
		                                   	<option value="{{$country->id}}" {{ old('pa_country_id', $row->pa_country_id ?? 0) == $country->id ? 'selected' : '' }}>{{$country->country_name}}</option>
		                                @endforeach
		                            @endif

			                    </select>
                                @error('pa_country_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6 pa-country-other" style="display: {{ old('pa_country_id', $row->pa_country_id ?? 0) == 2 ? '' : 'none'; }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country - Other </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <input type="text" name="pa_country_other" value="{{ old('pa_country_other', $row->pa_country_other ?? '') }}" class="form-control" placeholder="Enter Country - Other" />

                                @error('pa_country_other')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6 state-wrapper" style="display: {{ old('pa_country_id', $row->pa_country_id ?? 0) == 2 ? 'none' : ''; }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">State </label>
                            	<div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <select name="pa_state_id" id="pa_state_id" class="form-control form-control-lg form-control-custom selectpicker @error('pa_state_id') is-invalid @enderror" onchange="getCities(this, 'pa_state_id', 'pa_city_id', 'City')">
			                    	<option value="">Select State</option>

			                    </select>

                                @error('pa_state_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                	
                	<div class="col-6 state-wrapper" style="display: {{ old('pa_country_id', $row->pa_country_id ?? 0) == 2 ? 'none' : ''; }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City</label>
                            	<div class="col-lg-9 col-md-9 col-sm-12">
                               
                               	<select name="pa_city_id" id="pa_city_id" class="form-control form-control-lg form-control-custom selectpicker @error('pa_city_id') is-invalid @enderror" data-live-search="true" onchange="checkOtherCity(this, 'pa-city-other')">
			                    	<option value="">Select City</option>

			                    </select>

                                @error('pa_city_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6 pa-city-other" style="display: {{ old('pa_city_id', $row->pa_city_id ?? 0) == 7934 ? '' : 'none'; }}">
				        <div class="form-group row validated">
				            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City - Other </label>
				            <div class="col-lg-9 col-md-9 col-sm-12">

				                <input type="text" name="pa_city_other" value="{{ old('pa_city_other', $row->pa_city_other ?? '') }}" class="form-control" placeholder="Enter City - Other" />

				                @error('pa_city_other')
				                    <div class="invalid-feedback">{{ $message }}</div>
				                @enderror
				            </div>
				        </div>
				    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pincode </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="pa_pincode" value="{{ old('pa_pincode') ? old('pa_pincode') :( isset($row->pa_pincode) ? $row->pa_pincode : '') }}" class="form-control" minlength="6" maxlength="6"  placeholder="Enter Pincode"/>
                                @error('pa_pincode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6" id="company_collective" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Company/Collective (If Applicable) </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control  no-summernote-editor" name="company_collective" placeholder="Enter Company/Collective">{{ old('company_collective', $row->company_collective ?? '') }}</textarea>
                                @error('company_collective')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6" id="members_numbers" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Max Member Allowed </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="number" name="max_allowed_member" value="{{ old('max_allowed_member', $row->max_allowed_member ?? '') }}" class="form-control" placeholder="Enter Allowed Max Member" readonly />
                                @error('max_allowed_member')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Organisation/ Foundation/ Trust you are associated with (if any)</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="organisation" value="{{ old('organisation') ? old('organisation') :( isset($row->organisation) ? $row->organisation : '') }}" class="form-control "   placeholder="Enter Name of the Artisan"/>
                                @error('organisation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6" id="stage_name" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Stage Name <i>(If Any)</i></label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control no-summernote-editor" name="stage_name" placeholder="Enter Stage Name">{{ old('stage_name') ? old('stage_name') : ( isset($row->stage_name) ? $row->stage_name : '') }}</textarea>
                                @error('stage_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                
                    <div class="col-6" id="artist_bio" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Bio</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control no-summernote-editor" name="artist_bio" id="artist_bio" placeholder="Enter Artist Bio">{{ old('artist_bio') ? old('artist_bio') : ( isset($row->artist_bio) ? $row->artist_bio : '') }}</textarea>
                                @error('artist_bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6" id="instagram_url" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Instagram URL </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="instagram_url" value="{{ old('instagram_url', $row->instagram_url ?? '') }}" class="form-control"   placeholder="Enter Instagram URL"/>
                                @error('instagram_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6" id="facebook_url" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Facebook URL </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="facebook_url" value="{{ old('facebook_url', $row->facebook_url ?? '') }}" class="form-control"   placeholder="Enter Facebook URL"/>
                                @error('facebook_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6" id="linkdin_url" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Linkdin URL </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="linkdin_url" value="{{ old('linkdin_url', $row->linkdin_url ?? '') }}" class="form-control"   placeholder="Enter Linkdin URL"/>
                                @error('linkdin_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6" id="twitter_url" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Twitter URL </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="twitter_url" value="{{ old('twitter_url',  $row->twitter_url ?? '') }}" class="form-control" placeholder="Enter Twitter URL"/>
                                @error('twitter_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                	<div class="col-6" id="website" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Website <i>(If Any)</i> </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="website" value="{{ old('website', $row->website ?? '') }}" class="form-control"   placeholder="Enter Website"/>
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                	<div class="col-6" id="practice_image_1" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Please upload 3 high resolution images of your practice. </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                            
                                <div class="row pb-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        
                                        <input type="file" name="practice_image_1"  class="form-control form-control-lg form-control-solid @error('practice_image_1') is-invalid @enderror " />
                                        <p class="text-muted small">( 5 MB to 10MB and 300 dpi )</p>
                                        
                                        Uploaded File: 
                                        @if(isset($row->practice_image_1) && !empty($row->practice_image_1))
                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->practice_image_1) }}">{{$row->practice_image_1}}</a>
                                        @else
                                        N/A
                                        @endif

                                        @error('practice_image_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                </div>
                                <div class="row pb-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        
                                        <input type="file" name="practice_image_2"  class="form-control form-control-lg form-control-solid @error('practice_image_2') is-invalid @enderror " />
                                        <p class="text-muted small">( 5 MB to 10MB and 300 dpi )</p>
                                        Uploaded File: 
                                        @if(isset($row->practice_image_2) && !empty($row->practice_image_2))
                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->practice_image_2) }}">{{$row->practice_image_2}}</a>
                                        @else
                                        N/A
                                        @endif

                                        @error('practice_image_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                </div>

                                <div class="row pb-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        
                                        <input type="file" name="practice_image_3"  class="form-control form-control-lg form-control-solid @error('practice_image_3') is-invalid @enderror " />
                                        <p class="text-muted small">( 5 MB to 10MB and 300 dpi )</p>
                                        Uploaded File: 
                                        @if(isset($row->practice_image_3) && !empty($row->practice_image_3))
                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->practice_image_3) }}">{{$row->practice_image_3}}</a>
                                        @else
                                        N/A
                                        @endif

                                        @error('practice_image_3')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6" id="practice_image_2" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Please upload 2 high resolution profile images. </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                            
                                <div class="row pb-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        
                                        <input type="file" name="profile_image_1"  class="form-control form-control-lg form-control-solid @error('profile_image_1') is-invalid @enderror " />
                                        <p class="text-muted small">( Please save file name as the Credit name )</p>
                                        Uploaded File: 
                                        @if(isset($row->profile_image_1) && !empty($row->profile_image_1))
                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->profile_image_1) }}">{{$row->profile_image_1}}</a>
                                        @else
                                        N/A
                                        @endif

                                        @error('profile_image_1')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                </div>

                                <div class="row pb-5">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        
                                        <input type="file" name="profile_image_2"  class="form-control form-control-lg form-control-solid @error('profile_image_2') is-invalid @enderror " />
                                        <p class="text-muted small">( Please save file name as the Credit name )</p>
                                        Uploaded File: 
                                        @if(isset($row->profile_image_2) && !empty($row->profile_image_2))
                                            <a target="_blank" href="{{ asset('uploads/users/'.$row->profile_image_2) }}">{{$row->profile_image_2}}</a>
                                        @else
                                        N/A
                                        @endif

                                        @error('profile_image_2')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                	<div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Have you been associated with Serendipity Arts in the past ? </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="has_serendipity_arts" tabindex="null"   onchange="serendipityArtsChangePress(this)">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('has_serendipity_arts') == 'Yes' || (isset($row->has_serendipity_arts) && $row->has_serendipity_arts == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ old('has_serendipity_arts') == 'No' || (isset($row->has_serendipity_arts) && $row->has_serendipity_arts == 'No') ? 'selected' : ''  }}>No</option>
                                </select>

                                @error('has_serendipity_arts')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-6 has-year" style="display: {{ old('has_serendipity_arts') == 'Yes' || (isset($row->has_serendipity_arts) && $row->has_serendipity_arts == 'Yes') ? '' : 'none' }};">
                        <div class="form-group row validated">
                        	<label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Year</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-custom selectpicker" name="year[]" id="year" tabindex="null" multiple="">
                                    <option value="">Select</option>
                                    @if( isset($years) && count($years))
                                        @foreach($years as $year)

                                           <option {{ !empty(old('year')) && old('year') == $year ? 'selected' : ( isset($row->year) && $row->year == $year ? 'selected' : '' ) }} value="{{$year}}">{{$year}}</option>

                                        @endforeach
                                    @endif
                                </select>

                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                	<div class="col-6" id="other_link" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Link with videos of your work </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="other_link" value="{{ old('other_link', $row->other_link ?? '') }}" class="form-control"  placeholder="Enter Link with videos of your work"/>
                                @error('other_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Password </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="password" name="password" value="" class="form-control" placeholder="Enter Password" autocomplete="new-password" />
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-6">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Confirm Password </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="password" name="password_confirm" value="" class="form-control" placeholder="Enter Confirm Password" autocomplete="new password_confirm" />
                                @error('password_confirm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 text-center">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a class="btn btn-light-danger" href="{{ route($moduleConfig['routes']['listRoute']) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script type="text/javascript">

	function serendipityArtsChangePress(_this){

		if($(_this).val() == 'Yes'){
			$(".has-year").show();
		} else {

			$(".has-year").hide();
		}
	}

	function samAsPermanentFun(_this){

		if($(_this).is(':checked')){
			$(".current_address_wrapper").hide();
		} else {

			$(".current_address_wrapper").show();
		}
	}

	function getStates(_this, source_id, target_id, title = '', selectedId = 0) {
	    var country_id = $('#'+source_id).val();

	    if(country_id){
		    $.ajax({
				type: "GET",
				url: "{{ url('states') }}/" + country_id,
				datatype: 'json',
				success: function (response) {
					if(response?.status){
						var options = '<option value="">Select '+title+'</option>';
						if(response.data.length) {
							for (var i = 0; i < response.data.length; i++) {

								var _selected = '';

								if(selectedId == response.data[i].id){

									_selected = 'selected';
								}

								options += '<option '+_selected+' value="'+response.data[i].id+'">'+response.data[i].state_name+'</option>';
							}

							$("#"+target_id).html(options);
							$("#"+target_id).selectpicker('refresh');

							getCities(null, 'pa_state_id', 'pa_city_id', 'State', <?php echo old( 'pa_city_id', $row->pa_city_id ?? 0 )?>);
						}
					}
				}
			});
	    } else {
	    	$("#"+target_id).html('<option value="">Select '+title+'</option>');
	    	$("#"+target_id).selectpicker('refresh');
	    }
    }

    function getCities(_this, source_id, target_id, title = '', selectedId = 0) {

	    var state_id = $('#'+source_id).val();
	    if (state_id){
		    $.ajax({
				type: "GET",
				url: "{{ url('cities') }}/" + state_id,
				datatype: 'json',
				success: function (response) {
					if(response?.status){
						var options = '<option value="">Select '+title+'</option>';
						if(response.data.length){
							for (var i = 0; i < response.data.length; i++) {

								var _selected = '';

								if(selectedId == response.data[i].id){

									_selected = 'selected';
								}

								options += '<option '+_selected+' value="'+response.data[i].id+'">'+response.data[i].city_name+'</option>';
							}

							$("#"+target_id).html(options);
							$("#"+target_id).selectpicker('refresh');
						}
					}
				}
			});
	    } else {
	    	$("#"+target_id).html('<option value="">Select '+title+'</option>');
	    	$("#"+target_id).selectpicker('refresh');
	    }
    }

    function getProjects(_this, selectedId = 0) {
        var years = $('#year').val();

        if(years){
            $.ajax({
                type: "GET",
                url: "{{ url('projects') }}/?year=" + years,
                datatype: 'json',
                success: function (response) {
                    if(response?.status){
                        var options = '<option value="">Select Project</option>';
                        if(response.data.length) {
                            for (var i = 0; i < response.data.length; i++) {

                                var _selected = '';

                                if(selectedId == response.data[i].id){

                                    _selected = 'selected';
                                }

                                options += '<option '+_selected+' value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
                            }

                            $("#project_id").html(options);
                            $("#project_id").selectpicker('refresh');
                        }
                    }
                }
            });
        } else {
            $("#project_id").html('<option value="">Select Project</option>');
            $("#project_id").selectpicker('refresh');
        }
    }

    function checkOtherCountry(_this){

        if($(_this).val() == '2'){
            $(".state-wrapper").hide();
            $("#pa_state_id").val('');
            $("#pa_state_id").selectpicker('refresh');

            $(".city-wrapper").hide();
            $("#pa_city_id").val('');
            $("#pa_city_id").selectpicker('refresh');

            $(".pa-country-other").show();
        } else {

            $(".state-wrapper").show();
            $(".city-wrapper").show();
            // $(".pa-city-other").show();
            $(".pa-country-other").hide();
        }

        $("#pa_city_id").trigger('onchange');
        // checkOtherCity($("#pa_city_id").html(), 'pa-city-other');

    }

    function checkOtherCity(_this, selector = ''){

		if($(_this).val() == '7934'){
			$("." + selector).show();
		} else {

			$("." + selector).hide();
		}
	}

 	$(document).ready(function(){
		
		getStates(null, 'pa_country_id', 'pa_state_id', 'State', <?php echo old( 'pa_state_id', $row->pa_state_id ?? 0 )?>);

        getProjects(null, <?php echo old( 'project_id', $row->project_id ?? 0 )?>);

    });

    function groupFieldShow() {

        var frontendRole = $('select[name="frontend_role_id"] option:selected').text();
        if (frontendRole == 'Individual') {
            $('#marketingSocialMedia').show();
            $('#dob').show();
            $('#stage_name').show();
            $('#artist_bio').show();
            $('#instagram_url').show();
            $('#facebook_url').show();
            $('#linkdin_url').show();
            $('#twitter_url').show();
            $('#website').show();
            $('#practice_image_1').show();
            $('#practice_image_2').show();
            $('#other_link').show();
            $('#company_collective').hide();
        }else {
            $('#marketingSocialMedia').hide();
            $('#dob').hide();
            $('#stage_name').hide();
            $('#artist_bio').hide();
            $('#instagram_url').hide();
            $('#facebook_url').hide();
            $('#linkdin_url').hide();
            $('#twitter_url').hide();
            $('#website').hide();
            $('#practice_image_1').hide();
            $('#practice_image_2').hide();
            $('#other_link').hide();
            $('#company_collective').show();
        }
    }

</script>
@endpush