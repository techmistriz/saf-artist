@include('flash::message')
<div class="row">
    <div class="col-md-12">
        
        <div class="card card-custom gutter-b">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ isset($row) && !empty($row) ? 'Edit' : 'Add' }} {{$moduleConfig['moduleTitle']}}</h3>
                </div>
            </div>
            
            <div class="card-body">                
                <div class="row">

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">User Profile</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="profile_id" tabindex="null" onchange="userProfile()" required>
                                    <option value="" data-slug="">Select User Profile</option>
                                    @if($userProfiles->count())
                                        @foreach($userProfiles as $value)
                                          <option {{ (old('profile_id') ?? optional($row)->profile_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->festival->name . ' ('. $value->project_year . ')'}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('profile_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> 
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Purpose of travel</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="travel_purpose_id" tabindex="null">
                                    <option value="">Select purpose of travel</option>
                                    @if($travelPurposes->count())
                                        @foreach($travelPurposes as $value)
                                          <option {{ (old('travel_purpose_id') ?? optional($row)->travel_purpose_id) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('travel_purpose_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" style="{{ isset($user->frontendRole->name) && ($user->frontendRole->name == 'Individual') ? 'display:none;' : ''}}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Profile Member</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="profile_member_ids[]" tabindex="null" multiple>
                                    <option value="">Select Profile Member</option>
                                </select>
                                @error('profile_member_ids')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror                                
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <select class="form-control selectpicker" name="project_ids[]" tabindex="null" multiple data-live-search="true">
                                    <option value="">Select Project</option>
                                    @if($projects->count())
                                        @foreach($projects as $value)

                                            <option {{ in_array($value->id, old('project_ids', $row->project_ids ?? [])) ? 'selected' :'' }} value="{{$value->id}}">{{$value->name}} </option>

                                        @endforeach
                                    @endif
                                </select>
                                @error('project_ids')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Title </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control selectpicker" name="salutation" tabindex="null">
                                    <option value="">Select</option>
                                    <option value="Mr" {{ old('salutation') == 'Mr' || (isset($row->salutation) && $row->salutation == 'Mr') ? 'selected' : '' }}>Mr</option>
                                    <option value="Mrs" {{ old('salutation') == 'Mrs' || (isset($row->salutation) && $row->salutation == 'Mrs') ? 'selected' : ''  }}>Mrs</option>
                                    <option value="Miss" {{ old('salutation') == 'Miss' || (isset($row->salutation) && $row->salutation == 'Miss') ? 'selected' : ''  }}>Miss</option>
                                    <option value="Ms" {{ old('salutation') == 'Ms' || (isset($row->salutation) && $row->salutation == 'Ms') ? 'selected' : ''  }}>Ms</option>
                                </select>
                                @error('salutation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Traveller Name As Per Gov. ID  </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="name" id="name" value="{{ old('name', $row->name ?? '')}}" class="form-control" placeholder="Enter Traveller Name As Per Gov. ID" readonly/>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Age </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="age" value="{{ old('age', $row->age ?? '')}}" class="form-control" placeholder="Enter Age"/>
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact Number </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="contact" id="contact" value="{{ old('contact', $row->contact ?? '') }}" class="form-control" placeholder="Enter Contact Number" readonly/>
                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email ID </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="email" id="email" value="{{ old('email', $row->email ?? '') }}" class="form-control" placeholder="Enter Email" readonly/>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">International/Domestic Traveller </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="international_or_domestic" tabindex="null" onchange="travellerField()">
                                    <option value="">Your traveller</option>
                                    <option value="International" {{ old('international_or_domestic') == 'International' || (isset($row->international_or_domestic) && $row->international_or_domestic == 'International') ? 'selected' : '' }}>International</option>
                                    <option value="Domestic" {{ old('international_or_domestic') == 'Domestic' || (isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic') ? 'selected' : ''  }}>Domestic</option>
                                </select>
                                @error('international_or_domestic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="front_passport" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic' ? 'display:none;' : '' }}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Upload Passport (Front Side Image) </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <div class="image-input image-input-outline" id="front_side_passport" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">

                                    @if(isset($row->front_side_passport) && !empty($row->front_side_passport))
                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/passports/'.$row->front_side_passport)}})"></div>
                                    @else
                                        <div class="image-input-wrapper front_side_passport_base64"></div>
                                    @endif

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="front_side_passport" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="front_side_passport_remove"/>
                                    </label>

                                    @if(isset($row->front_side_passport) && !empty($row->front_side_passport))
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @else
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @endif
                                </div>

                                @error('front_side_passport')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="back_passport" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic' ? 'display:none;' : '' }}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Upload Passport (Back Side Image) </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <div class="image-input image-input-outline" id="back_side_passport" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">

                                    @if(isset($row->back_side_passport) && !empty($row->back_side_passport))
                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/passports/'.$row->back_side_passport)}})"></div>
                                    @else
                                        <div class="image-input-wrapper back_side_passport_base64"></div>
                                    @endif

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="back_side_passport" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="back_side_passport_remove"/>
                                    </label>

                                    @if(isset($row->back_side_passport) && !empty($row->back_side_passport))
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @else
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @endif
                                </div>

                                @error('back_side_passport')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="work_visa" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic' ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Do you have work visa for India</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-solid selectpicker" name="work_visa" tabindex="null" onchange="visaField()">
                                    <option value="">Select</option>
                                    <option value="Yes" {{ old('work_visa') == 'Yes' || (isset($row->work_visa) && $row->work_visa == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ old('work_visa') == 'No' || (isset($row->work_visa) && $row->work_visa == 'No') ? 'selected' : ''  }}>No</option>
                                </select>
                                @error('work_visa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div> 

                    <div class="col-12" id="visa" style="{{(isset($row->international_or_domestic) && $row->international_or_domestic == 'International') && (isset($row->work_visa) && $row->work_visa == 'Yes') ? '' : 'display:none;' }}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Upload Visa </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <div class="image-input image-input-outline" id="upload_visa" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">

                                    @if(isset($row->upload_visa) && !empty($row->upload_visa))
                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/work_visas/'.$row->upload_visa)}})"></div>
                                    @else
                                        <div class="image-input-wrapper upload_visa_base64"></div>
                                    @endif

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="upload_visa" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="upload_visa_remove"/>
                                    </label>

                                    @if(isset($row->upload_visa) && !empty($row->upload_visa))
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @else
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @endif
                                </div>

                                @error('upload_visa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="link" style="{{(isset($row->international_or_domestic) && $row->international_or_domestic == 'International') && (isset($row->work_visa) && $row->work_visa == 'No') ? '' : 'display:none;' }}">
                        <div class="form-group row validated">
                            <div class="col-lg-9 col-md-9 col-sm-12">
                               <a href="#">Apply Visa</a>
                            </div>
                        </div>
                    </div>                   

                    <div class="col-12" id="adhaar_driving" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'International' ? 'display:none;' : '' }}">

                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Upload Adhaar card or Driving License </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                
                                <div class="image-input image-input-outline" id="adhaarcard_driving" style="background-image: url({{asset('media/users/blank_Img.jpg')}})">

                                    @if(isset($row->adhaarcard_driving) && !empty($row->adhaarcard_driving))
                                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/adhaarcard_drivings/'.$row->adhaarcard_driving)}})"></div>
                                    @else
                                        <div class="image-input-wrapper adhaarcard_driving_base64"></div>
                                    @endif

                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="adhaarcard_driving" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="adhaarcard_driving_remove"/>
                                    </label>

                                    @if(isset($row->adhaarcard_driving) && !empty($row->adhaarcard_driving))
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @else
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                                        </span>
                                    @endif
                                </div>

                                @error('adhaarcard_driving')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Onward Date </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <div class="input-group date">
                                    <input type="text" name="onward_date" id="onward_date" value="{{ old('onward_date', $row->onward_date ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Onward Date" />

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('onward_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Onward Flight Timing Slots(like: 9:00 am to 12:00 pm)<i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Preferred time of arrival for onward(like: 9:00 am to 12:00 pm)"></i></label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <input type="text" name="onword_flight_timing_slot" value="{{ old('onword_flight_timing_slot', $row->onword_flight_timing_slot ?? '') }}" class="form-control" placeholder="Enter Onward Flight Timing Slots" />

                                @error('onword_flight_timing_slot')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Onward (Mention City)</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <input type="text" name="onward_city" value="{{ old('onward_city', $row->onward_city ?? '') }}" class="form-control" placeholder="Enter Onward (Mention City)" />

                                @error('onward_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return Date </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <div class="input-group date">
                                    <input type="text" name="return_date" id="return_date" value="{{ old('return_date', $row->return_date ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Return Date" />

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="la la-calendar-check-o"></i>
                                        </span>
                                    </div>
                                </div>

                                @error('return_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return Flight Timing Slots(like: 9:00 am to 12:00 pm)<i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Preferred Time of departure for return(like: 9:00 am to 12:00 pm)"></i></label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <input type="text" name="return_flight_timing_slot" value="{{ old('return_flight_timing_slot', $row->return_flight_timing_slot ?? '') }}" class="form-control" placeholder="Enter Return Flight Timing Slots" />

                                @error('return_flight_timing_slot')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return City</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">

                                <input type="text" name="return_city" value="{{ old('return_city', $row->return_city ?? '') }}" class="form-control" placeholder="Enter Return City"/>

                                @error('return_city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pick up Required</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-custom selectpicker" name="pickup_required" tabindex="null" onchange="hideCabDetails()">
                                    <option value="">Select Pick up Required</option>
                                    <option value="Yes" {{ old('pickup_required') == 'Yes' || (isset($row->pickup_required) && $row->pickup_required == 'Yes') ? 'selected' : '' }}>Yes</option>
                                    <option value="No" {{ old('pickup_required') == 'No' || (isset($row->pickup_required) && $row->pickup_required == 'No') ? 'selected' : '' }}>No</option>
                                </select>
                                @error('pickup_required')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="cabOption" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'International' ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Cab Option</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-custom selectpicker" name="cab_option" tabindex="null">
                                    <option value="">Select Cab Option</option>
                                    <option value="1" {{ old('cab_option') == '1' || (isset($row->cab_option) && $row->cab_option == '1') ? 'selected' : '' }}>Transfer Only</option>
                                    <option value="2" {{ old('cab_option') == '2' || (isset($row->cab_option) && $row->cab_option == '2') ? 'selected' : '' }}>Dedicated</option>
                                </select>
                                @error('cab_option')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="numberOfCabs" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'International' ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Number of Cabs</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" name="number_of_cabs" value="{{ old('number_of_cabs', $row->number_of_cabs ?? '') }}" class="form-control" placeholder="Enter Number of Cabs" />
                                @error('number_of_cabs')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-12" id="cabDateRange" style="{{isset($row->international_or_domestic) && $row->international_or_domestic == 'International' ? 'display:none;' : '' }}">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Cab Date Range</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class='input-group' id='kt_daterangepicker_2'>
                                    <input type='text' name="cab_date_range" value="{{ old('cab_date_range', $row->cab_date_range ?? '') }}" class="form-control" readonly  placeholder="Select Cab Date Range"/>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="la la-calendar-check-o"></i></span>
                                    </div>
                                </div>
                                @error('cab_date_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks<i class="fa fa-question" data-toggle="tooltip" data-placement="right" title="Tooltip on right"></i></label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <textarea class="form-control no-summernote-editor" name="artist_remarks" id="artist_remarks" placeholder="Enter artist remarks">{{ old('artist_remarks', $row->artist_remarks ?? '') }}</textarea>
                                @error('artist_remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                     <div class="col-12">
                        <h4 class="card-label">Ticket status change</h4><hr>
                    </div>
                    <div class="col-12">
                        <div class="form-group row validated">
                            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Ticket Status</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control form-control-lg form-control-custom selectpicker" name="ticket_status" tabindex="null">
                                    <option value="">Select Ticket Status</option>
                                    <option value="1" {{ old('ticket_status') == '1' || (isset($row->ticket_status) && $row->ticket_status == '1') ? 'selected' : '' }}>Pending</option>
                                    <option value="2" {{ old('ticket_status') == '2' || (isset($row->ticket_status) && $row->ticket_status == '2') ? 'selected' : '' }}>In Review</option>
                                    <option value="3" {{ old('ticket_status') == '3' || (isset($row->ticket_status) && $row->ticket_status == '3') ? 'selected' : '' }}>Freeze</option>
                                </select>
                                @error('ticket_status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
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
                        <a class="btn btn-light-danger" href="{{route('admin.user.index')}}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script type="text/javascript">
        // START upload_passport
        var front_side_passport = new KTImageInput('front_side_passport');

        front_side_passport.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Okay!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        front_side_passport.on('change', function(imageInput) {
            
        });

        front_side_passport.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        var back_side_passport = new KTImageInput('back_side_passport');

        back_side_passport.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Okay!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        back_side_passport.on('change', function(imageInput) {
            
        });

        back_side_passport.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
        // END upload_passport

        // START adhaarcard_driving
        var adhaarcard_driving = new KTImageInput('adhaarcard_driving');

        adhaarcard_driving.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Okay!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        adhaarcard_driving.on('change', function(imageInput) {
            
        });

        adhaarcard_driving.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
        // END adhaarcard_driving

         // START upload_visa
        var upload_visa = new KTImageInput('upload_visa');

        upload_visa.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Okay!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        upload_visa.on('change', function(imageInput) {
            
        });

        upload_visa.on('remove', function(imageInput) {
            swal.fire({
                title: 'Image successfully removed !',
                type: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });
        // END upload_visa

        // start field hide

        $(document).ready(function(){
        
            travellerField();
            userProfile();            
        });
        function travellerField() {

            var traveller = $('select[name="international_or_domestic"] option:selected').text();
            var work_visa = $('select[name="work_visa"] option:selected').val();

            if (traveller == 'International') {
                if (work_visa == 'Yes') {
                    $('#visa').show();
                    $('#link').hide();
                }else{
                    $('#visa').hide();
                    $('#link').show();
                }                
                $('#work_visa').show();
                $('#front_passport').show();
                $('#back_passport').show();
                $('#dob').hide();
                $('#adhaar_driving').hide();
            }else if(traveller == 'Domestic'){
                $('#visa').hide();
                $('#link').hide();
                $('#work_visa').hide();
                $('#front_passport').hide();
                $('#back_passport').hide();
                $('#dob').show();
                $('#adhaar_driving').show();
            }else{
                $('#visa').hide();
                $('#link').hide();
                $('#work_visa').hide();
                $('#front_passport').hide();
                $('#back_passport').hide();
                $('#dob').hide();
                $('#adhaar_driving').hide();
            }
        } 

        function visaField(){

            var work_visa = $('select[name="work_visa"] option:selected').val();
            if (work_visa == 'Yes') {
                $('#visa').show();
                $('#link').hide();
            }else{ 
                $('#visa').hide();
                $('#link').show();
            }
        }

        // end field hide 

        function userProfile()
        {
            getUserDetails();
            getProfileMember();
        }

        function getProfileMember() {
            var profile_id = $('select[name=profile_id]').val();
            var selectedIds = {!! json_encode(old('profile_member_ids', $row->profile_member_ids ?? [])) !!};

            if(profile_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ticket-profile-members') }}?profile_id=" + profile_id + '&profile_member_id=' + selectedIds,
                    datatype: 'json',
                    success: function (response) {
                        if(response?.status) {
                            var options = '<option value="">Select Profile Member</option>';
                            if(response.data.length) {                            

                                for (var i = 0; i < response.data.length; i++) {
                                    var _selected = selectedIds.includes(response.data[i].id.toString()) ? 'selected' : '';
                                    options += '<option ' + _selected + ' value="' + response.data[i].id + '">' + response.data[i].name + '</option>';
                                }
                                $("select[name='profile_member_ids[]']").html(options);
                                $("select[name='profile_member_ids[]']").selectpicker('refresh');
                            }
                        }
                    }
                });
            } else {
                $("select[name='profile_member_ids[]']").html('<option value="">Select Profile Member</option>');
                $("select[name='profile_member_ids[]']").selectpicker('refresh');
            }
        }


        function getUserDetails() {

            var profile_id = $('select[name=profile_id]').val();

            if(!profile_id){
                return false
            }

            $.ajax({
                type: 'GET',
                url: "{{ url('fetch-user-detail') }}",
                data: {
                    profile_id:profile_id
                },
                success: function (response) {
                    if (response.status) {
                        var data = response?.data[0];
                        $("#name").val(data?.name);
                        $("#email").val(data?.email);
                        $("#contact").val(data?.contact);
                    }
                },
                error: function (error) {
                    console.error('Error fetching user details:', error);
                }
            });
        }

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script type="text/javascript">
        var KTBootstrapDaterangepicker = function () {
            var demos = function () {
                $('#kt_daterangepicker_2').daterangepicker({
                    buttonClasses: ' btn',
                    applyClass: 'btn-primary',
                    cancelClass: 'btn-secondary'
                }, function(start, end, label) {
                    $('#kt_daterangepicker_2 .form-control').val( start.format('DD-MMM-YYYY') + '  to  ' + end.format('DD-MMM-YYYY'));
                });

                $('#kt_daterangepicker_2_modal').daterangepicker({
                    buttonClasses: ' btn',
                    applyClass: 'btn-primary',
                    cancelClass: 'btn-secondary'
                }, function(start, end, label) {
                    $('#kt_daterangepicker_2 .form-control').val( start.format('DD-MMM-YYYY') + '  to  ' + end.format('DD-MMM-YYYY'));
                });
            }

            return {
                init: function() {
                    demos();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTBootstrapDaterangepicker.init();
        });

        function hideCabDetails() {
            var pickup_required = $('select[name="pickup_required"] option:selected').val();
            if (pickup_required == 'Yes') {
                $('#cabOption').show().attr('required', true);
                $('#numberOfCabs').show().attr('required', true);
                $('#cabDateRange').show().attr('required', true);
            } else { 
                $('#cabOption').hide().removeAttr('required');
                $('#numberOfCabs').hide().removeAttr('required');
                $('#cabDateRange').hide().removeAttr('required');
            }
        }

    </script>
@endpush