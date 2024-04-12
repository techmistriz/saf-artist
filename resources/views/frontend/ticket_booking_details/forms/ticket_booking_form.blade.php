<div class="row">

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <!-- <input type="text" name="project_name" value="{{ old('project_name', $row->project_name ?? '')}}" class="form-control form-control-solid form-control-lg" placeholder="Enter Project Name"/>
                @error('project_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror -->

                <select class="form-control form-control-lg form-control-solid selectpicker" name="project_name" tabindex="null" >
                    <option value="">Select</option>
                   	@if($projects->count())
                        @foreach($projects as $value)

                           <option {{ old('project_name', $row->project_name ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                        @endforeach
                    @endif
                </select>
                @error('project_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Title </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select class="form-control form-control-lg form-control-solid selectpicker" name="salutation" tabindex="null">
                    <option value="">Select</option>
                    <option value="Mr" {{ old('salutation') == 'Mr' || (isset($row->salutation) && $row->salutation == 'Mr') ? 'selected' : '' }}>Mr</option>
                    <option value="Ms" {{ old('salutation') == 'Ms' || (isset($row->salutation) && $row->salutation == 'Ms') ? 'selected' : ''  }}>Ms</option>
                    <option value="Mrs" {{ old('salutation') == 'Mrs' || (isset($row->salutation) && $row->salutation == 'Mrs') ? 'selected' : ''  }}>Mrs</option>
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
                <input type="text" name="name" value="{{ old('name', $user->name ?? '')}}" class="form-control form-control-solid form-control-lg" placeholder="Enter Traveller Name As Per Gov. ID" readonly/>
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
                <input type="text" name="age" value="{{ old('age', $user->getAge() ?? '')}}" class="form-control form-control-solid form-control-lg" placeholder="Enter Age" readonly/>
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
                <input type="text" name="contact" value="{{ old('contact', $user->contact ?? '')}}" class="form-control form-control-solid form-control-lg" placeholder="Enter Contact Number" readonly/>
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
                <input type="text" name="email" value="{{ old('email', $user->email ?? '')}}" class="form-control form-control-solid form-control-lg" placeholder="Enter Email" readonly/>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Onward (Mention City) </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select name="onward_city_id" id="onward_city_id" class="form-control form-control-solid form-control-lg form-control-lg form-control-custom selectpicker @error('onward_city_id') is-invalid @enderror" data-live-search="true" onchange="checkOtherCity(this, 'onward-city-other')">
                    <option value="">Select</option>

                    @if($cities->count())
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" {{ old('onward_city_id', $row->onward_city_id ?? '') == $city->id ? 'selected' : '' }}>{{$city->city_name}}</option>
                        @endforeach
                    @endif

                </select>
                @error('onward_city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 onward-city-other" style="display: {{ old('onward_city_id', $row->onward_city_id ?? 0) == 7934 ? '' : 'none'; }}">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Onward (Mention City) - Other </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <input type="text" name="onward_city_other" value="{{ old('onward_city_other', $row->onward_city_other ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Onward (Mention City) - Other" />

                @error('onward_city_other')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return City </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select name="return_city_id" id="return_city_id" class="form-control form-control-solid form-control-lg form-control-lg form-control-custom selectpicker @error('return_city_id') is-invalid @enderror" data-live-search="true" onchange="checkOtherCity(this, 'return-city-other')">
                    <option value="">Select</option>

                    @if($cities->count())
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" {{ old('return_city_id', $row->return_city_id ?? '') == $city->id ? 'selected' : '' }}>{{$city->city_name}}</option>
                        @endforeach
                    @endif

                </select>
                @error('return_city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 return-city-other" style="display: {{ old('return_city_id', $row->return_city_id ?? 0) == 7934 ? '' : 'none'; }}">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return City - Other </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <input type="text" name="return_city_other" value="{{ old('return_city_other', $row->return_city_other ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Return City - Other" />

                @error('return_city_other')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control form-control-solid form-control-lg no-summernote-editor" name="artist_remarks" id="artist_remarks" placeholder="Enter artist remarks">{{ old('artist_remarks', $row->artist_remarks ?? '') }}</textarea>
                @error('artist_remarks')
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
                    <option value="">Select International or Domestic Traveller</option>
                    <option value="International" {{ old('international_or_domestic') == 'International' || (isset($row->international_or_domestic) && $row->international_or_domestic == 'International') ? 'selected' : '' }}>International</option>
                    <option value="Domestic" {{ old('international_or_domestic') == 'Domestic' || (isset($row->international_or_domestic) && $row->international_or_domestic == 'Domestic') ? 'selected' : ''  }}>Domestic</option>
                </select>
                @error('international_or_domestic')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated" id="visa">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Do you have work visa for India</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select class="form-control form-control-lg form-control-solid selectpicker" name="work_visa" tabindex="null">
                    <option value="">Select Work visa for India</option>
                    <option value="Yes" {{ old('work_visa') == 'Yes' || (isset($row->work_visa) && $row->work_visa == 'Yes') ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('work_visa') == 'No' || (isset($row->work_visa) && $row->work_visa == 'No') ? 'selected' : ''  }}>No</option>
                </select>
                @error('work_visa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12" id="passport">

        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Upload Passport (Image) </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                
                <div class="image-input image-input-outline" id="upload_passport" style="background-image: url({{asset('media/users/blank.png')}})">

                    @if(isset($row->upload_passport) && !empty($row->upload_passport))
                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/passports/'.$row->upload_passport)}})"></div>
                    @else
                        <div class="image-input-wrapper upload_passport_base64"></div>
                    @endif

                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="upload_passport" accept=".png, .jpg, .jpeg"/>
                        <input type="hidden" name="upload_passport_remove"/>
                    </label>

                    @if(isset($row->upload_passport) && !empty($row->upload_passport))
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    @else
                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel">
                            <i class="ki ki-bold-close icon-xs text-muted"></i>
                        </span>
                    @endif
                </div>

                @error('upload_passport')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

    <div class="col-12" id="adhaar_driving">

        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left title-case">Upload Adhaar card or Driving License </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                
                <div class="image-input image-input-outline" id="adhaarcard_driving" style="background-image: url({{asset('media/users/blank.png')}})">

                    @if(isset($row->adhaarcard_driving) && !empty($row->adhaarcard_driving))
                        <div class="image-input-wrapper" style="background-image: url({{asset('uploads/passports/'.$row->adhaarcard_driving)}})"></div>
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

    <div class="col-12" id="dob" style="">
                                    
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DOB </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="dob" value="{{ old('dob', $row->dob ?? '') }}" class="form-control form-control-lg form-control-solid kt_datepicker" {{isset($row->dob) ? '':''}} placeholder="Enter DOB" autocomplete="new dob" readonly />

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

</div>

@push('scripts')
    <script type="text/javascript">
        // START upload_passport
        var upload_passport = new KTImageInput('upload_passport');

        upload_passport.on('cancel', function(imageInput) {
            swal.fire({
                title: 'Image successfully canceled !',
                type: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Okay!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
        });

        upload_passport.on('change', function(imageInput) {
            
        });

        upload_passport.on('remove', function(imageInput) {
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

        // start field hide
        function travellerField() {

            var traveller = $('select[name="international_or_domestic"] option:selected').text();
            if (traveller == 'International') {
                $('#visa').show();
                $('#passport').show();
                $('#dob').hide();
                $('#adhaar_driving').hide();
            }else {
                $('#visa').hide();
                $('#passport').hide();
                $('#dob').show();
                $('#adhaar_driving').show();
            }
        } 
        // end field hide 
    </script>
@endpush

