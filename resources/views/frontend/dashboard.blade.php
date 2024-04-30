@extends('layouts.frontend')

@section('content')

<style type="text/css">
    .radio {
        display: -webkit-box;
    }

    .image-input {
        margin-right: 10px;
    }

    .bootstrap-select>.dropdown-toggle.btn-light, .bootstrap-select>.dropdown-toggle.btn-secondary {
        height: calc(1.5em + 1.65rem + 2px);
        padding: 0.825rem 1.42rem;
        font-size: 1.08rem;
        line-height: 1.5;
        border-radius: 0.42rem;
        background-color: #f3f6f9 !important;
        border-color: #f3f6f9 !important;
    }    

    /*.form-group .form-control{
        width: 100%;
    }*/
    

</style>

<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container container-fluid">

        

        <!--begin::Education-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            @include('frontend/includes/aside')
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom gutter-bs">
                    <form action="{{ route('update.profile') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="{{$row->id}}">
                        {{ csrf_field() }}

                        <!--Begin::Header-->
                        <div class="card-header">

                            @include('includes.common.error')
                            @include('flash::message')
                            <div class="row" style="justify-content: space-between;">
                                <div class="card-title">
                                    @if(isset($row->frontendRole->name) && !empty($row->frontendRole->name))
                                        <h3 class="card-label">{{ $row->frontendRole->name }} Personal Details</h3>
                                    @endif
                                </div>
                                <div  style="margin-right: 20px; {{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' : ''}}">
                                    <a href="{{route('group.member.create')}}" class="btn font-weight-bold ml-2" id="button">Add Member</a>
                                </div>                                
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--Begin::Body-->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">User Type</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="frontend_role_id" id="frontend_role_id" class="form-control form-control-lg form-control-solid" value="{{$row->frontendRole->name}}" readonly>
                                            @error('frontend_role_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Category <i class="fa fa-info" data-toggle="tooltip" data-placement="right" title="Tooltip on right"></i></label>
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

                                <div class="col-12">
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

                                <div class="col-12">
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

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Full Name </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" value="{{ $row->name ?? '' }}" class="form-control form-control-lg form-control-solid" placeholder="Enter Full Name" readonly />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12" id="dob" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">
                                    
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DOB </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">

                                            <div class="input-group date">
                                                <input type="text" name="dob" value="{{ old('dob') ? old('dob') : ( isset($row->dob) ? $row->dob : '') }}" class="form-control form-control-lg form-control-solid kt_datepicker" {{isset($row->dob) ? '':''}} placeholder="Enter DOB" autocomplete="new dob" readonly />

                                                @error('dob')
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
                                
                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">

                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <select name="country_code" id="country_code" class="form-control form-control-lg form-control-solid form-control-custom selectpicker @error('country_code') is-invalid @enderror">
                                                        <option value="">Select</option>

                                                        @if($countries->count())
                                                            @foreach($countries as $country)
                                                                @if($country->std_code != '')
                                                                    <option value="{{$country->std_code}}" {{ old('country_code', $row->country_code ?? 0) == $country->std_code ? 'selected' : '' }}>{{$country->std_code}}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif

                                                    </select>
                                                    @error('country_code')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-lg-9 col-md-9 col-sm-9">
                                                    <input type="text" oninput="this.value=this.value.replace(/[^0-9]/, '')"  value="{{ $row->contact ?? '' }}" class="form-control form-control-lg form-control-solid" minlength="10" maxlength="10"  placeholder="Enter Contact" readonly/>
                                                    @error('contact')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" value="{{ $row->email ?? '' }}" class="form-control form-control-lg form-control-solid" placeholder="Enter Email" readonly />
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Address </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea class="form-control form-control-lg form-control-solid no-summernote-editor" name="permanent_address" id="permanent_address" placeholder="Enter Address">{{ old('permanent_address', $row->permanent_address ?? '') }}</textarea>
                                            @error('permanent_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12">
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

                                <div class="col-12 pa-country-other" style="display: {{ old('pa_country_id', $row->pa_country_id ?? 0) == 2 ? '' : 'none'; }}">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Country - Other </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">

                                            <input type="text" name="pa_country_other" value="{{ old('pa_country_other', $row->pa_country_other ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Country - Other" />

                                            @error('pa_country_other')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 state-wrapper" style="display: {{ old('pa_country_id', $row->pa_country_id ?? 0) == 2 ? 'none' : ''; }}">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">State </label>
                                            <div class="col-lg-9 col-md-9 col-sm-12">
                                            
                                            <select name="pa_state_id" id="pa_state_id" class="form-control form-control-lg form-control-custom selectpicker @error('pa_state_id') is-invalid @enderror" data-live-search="true" onchange="getCities(this, 'pa_state_id', 'pa_city_id', 'City')">
                                                <option value="">Select State</option>

                                            </select>

                                            @error('pa_state_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 state-wrapper" style="display: {{ old('pa_country_id', $row->pa_country_id ?? 0) == 2 ? 'none' : ''; }}">
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

                                <div class="col-12 pa-city-other" style="display: {{ old('pa_city_id', $row->pa_city_id ?? 0) == 7934 ? '' : 'none'; }}">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">City - Other </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">

                                            <input type="text" name="pa_city_other" value="{{ old('pa_city_other', $row->pa_city_other ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter City - Other" />

                                            @error('pa_city_other')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Pincode </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="pa_pincode" value="{{ old('pa_pincode') ? old('pa_pincode') :( isset($row->pa_pincode) ? $row->pa_pincode : '') }}" class="form-control form-control-lg form-control-solid"  minlength="6" maxlength="6"  placeholder="Enter Pincode"/>
                                            @error('pa_pincode')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12" id="company_collective" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Company/Collective (If Applicable) </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea class="form-control form-control-lg form-control-solid no-summernote-editor" name="company_collective" id="company_collective" placeholder="Enter Company/Collective">{{ old('company_collective', $row->company_collective ?? '') }}</textarea>
                                            @error('company_collective')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="row" id="members_numbers" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' :''}}">
                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Max Member Allowed </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="number" name="max_allowed_member" value="{{ $row->max_allowed_member ?? '' }}" class="form-control form-control-lg form-control-solid" placeholder="Enter Allowed Max Member" />
                                            @error('max_allowed_member')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? 'display:none;' :''}}" id="payment_troup">
                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Payment of the Troup</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select class="form-control form-control-solid form-control-lg form-control-lg form-control-solid selectpicker" name="payment_troup" tabindex="null">
                                                <option value="">Select Payment of the Troup</option>
                                                <option value="Single Account" {{ old('payment_troup') == 'Single Account' || (isset($row->payment_troup) && $row->payment_troup == 'Single Account') ? 'selected' : '' }}>Single Account</option>
                                                <option value="Individual Account" {{ old('payment_troup') == 'Individual Account' || (isset($row->payment_troup) && $row->payment_troup == 'Individual Account') ? 'selected' : '' }}>Individual Account</option>
                                            </select>

                                            @error('payment_troup')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="marketingSocialMedia" style="{{ isset($row->frontendRole->name) && ($row->frontendRole->name == 'Individual') ? '' :'display:none;'}}">

                                <div class="col-12">
                                    <h4 class="card-label">For marketing and social media purpose</h4><hr>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Stage Name <i>(If Any)</i> </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea class="form-control form-control-lg form-control-solid no-summernote-editor" name="stage_name" id="stage_name" placeholder="Enter Stage Name" maxlength="150">{{ old('stage_name') ? old('stage_name') : ( isset($row->stage_name) ? $row->stage_name : '') }}</textarea>
                                            @error('stage_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Bio <i>(150 words only) </i> </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea class="form-control form-control-lg form-control-solid no-summernote-editor" name="artist_bio" id="artist_bio" placeholder="Enter Artist Bio" maxlength="150">{{ old('artist_bio') ? old('artist_bio') : ( isset($row->artist_bio) ? $row->artist_bio : '') }}</textarea>
                                            @error('artist_bio')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Instagram Profile Link </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="instagram_url" value="{{ old('instagram_url') ? old('instagram_url') :( isset($row->instagram_url) ? $row->instagram_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Instagram Profile Link"/>
                                            @error('instagram_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Facebook Profile Link </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="facebook_url" value="{{ old('facebook_url') ? old('facebook_url') :( isset($row->facebook_url) ? $row->facebook_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Facebook Profile Link"/>
                                            @error('facebook_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>                                

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Linkdin Profile Link </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="linkdin_url" value="{{ old('linkdin_url') ? old('linkdin_url') :( isset($row->linkdin_url) ? $row->linkdin_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Linkdin Profile Link"/>
                                            @error('linkdin_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>                               

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Twitter Profile Link </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="twitter_url" value="{{ old('twitter_url') ? old('twitter_url') :( isset($row->twitter_url) ? $row->twitter_url : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Twitter Profile Link"/>
                                            @error('twitter_url')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Website <i>(If any)</i> </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="website" value="{{ old('website') ? old('website') :( isset($row->website) ? $row->website : '') }}" class="form-control form-control-lg form-control-solid"   placeholder="Enter Website"/>
                                            @error('website')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Please upload 3 high resolutions images of your practice (for use on social media and print collaterals)</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            
                                            <div class="row pb-5">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    
                                                    <input type="file" name="practice_image_1"  class="form-control form-control-lg form-control-solid @error('practice_image_1') is-invalid @enderror " />
                                                    <p class="text-muted small">( 5 MB to 10MB and 300 dpi )</p>
                                                    
                                                    Uploaded File: 
                                                    @if($row->practice_image_1)
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
                                                    @if($row->practice_image_2)
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
                                                    @if($row->practice_image_3)
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

                                <div class="col-12">

                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Please upload 2 high resolution profile images (For your festival ID and promotion)</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            
                                            <div class="row pb-5">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    
                                                    <input type="file" name="profile_image_1"  class="form-control form-control-lg form-control-solid @error('profile_image_1') is-invalid @enderror " />
                                                    <p class="text-muted small">( Please save file name as the Credit name )</p>
                                                    Uploaded File: 
                                                    @if($row->profile_image_1)
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
                                                    @if($row->profile_image_2)
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

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Have you been associated with Serendipity Arts in the past ? </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select class="form-control form-control-lg form-control-solid selectpicker" name="has_serendipity_arts" tabindex="null" onchange="serendipityArtsChangePress(this)">
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

                                <div class="col-12 has-year" style="display: {{ old('has_serendipity_arts') == 'Yes' || (isset($row->has_serendipity_arts) && $row->has_serendipity_arts == 'Yes') ? '' : 'none' }};">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Year</label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <select class="form-control form-control-lg form-control-solid selectpicker" name="year[]" id="year" tabindex="null" multiple="">
                                                <option value="">Select Year</option>
                                                @if( isset($years) && count($years))
                                                    @foreach($years as $year)

                                                       <option {{ in_array($year, old('year', $row->year ?? [] )) ? 'selected' : '' }} value="{{$year}}">{{$year}}</option>

                                                    @endforeach
                                                @endif
                                            </select>

                                            @error('year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Link with videos of your work <i>(If any)</i> </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" name="other_link" value="{{ old('other_link') ? old('other_link') :( isset($row->other_link) ? $row->other_link : '') }}" class="form-control form-control-lg form-control-solid"  placeholder="Enter Link with videos of your work"/>
                                            @error('other_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group row validated">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            &nbsp;
                                        </div>
                                        <div class="col-form-label col-lg-9 col-md-9 col-sm-12">
                                            <div class="checkbox-inline">
                                                <label class="checkbox">
                                                    <input type="checkbox" name="terms" value="1" required="" />
                                                    <span></span>
                                                    {{ env('FORM_CONSENT', 'I Accept Terms & Conditions') }}
                                                </label>
                                            </div>

                                            @error('terms')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--end::Body-->

                        <div class="card-footer">
                            <div class="row">
                                @if(\Auth::user()->is_freeze == 0)
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 text-center">
                                    <button type="submit" class="theme-btn mt-0 mb-0">Update</button>
                                </div>
                                @else
                                    <div class="col-lg-12">
                                        <p class="text-center text-danger small italic">Your account has been freeze by admin hence you are not able to update any of details.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>

                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Education-->
    </div>
    <!--end::Container-->
</div>
@endsection

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

                            if(selectedId){
                                getCities(null, 'pa_state_id', 'pa_city_id', 'State', <?php echo old( 'pa_city_id', $row->pa_city_id ?? 0 )?>);
                            }
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

    function marketingSocialMediaHide() {

        var frontendRole = $('select[name="frontend_role_id"] option:selected').text();
        if (frontendRole == 'Individual') {
            $('#marketingSocialMedia').show();
            $('#dob').show();
            $('#members_numbers').hide();
            $('#company_collective').hide();
            $('#payment_troup').hide();
        }else {
            $('#marketingSocialMedia').hide();
            $('#dob').hide();
            $('#members_numbers').show();
            $('#company_collective').show();
            $('#payment_troup').show();
        }
    }


    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    
</script>
@endpush