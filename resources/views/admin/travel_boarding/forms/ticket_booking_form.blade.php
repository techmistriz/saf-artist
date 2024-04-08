<div class="row">
    <div class="col-12">
        <h5 class="card-label">Ticket Booking</h5><hr>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select class="form-control form-control-lg form-control-solid selectpicker" name="project_name" tabindex="null" >
                    <option value="">Select</option>
                   	@if($projects->count())
                        @foreach($projects as $value)

                           <option {{ old('project_name', $row->travelBoarding->project_name ?? 0) == $value->id ? 'selected' : '' }} value="{{$value->id}}">{{$value->name}}</option>

                        @endforeach
                    @endif
                </select>
                @error('project_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Cost Center </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="cost_center" value="{{ old('cost_center', $row->travelBoarding->cost_center ?? '')}}" class="form-control" placeholder="Enter Cost Center"/>
                @error('cost_center')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Program Manager </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="prog_manager" value="{{ old('prog_manager', $row->travelBoarding->prog_manager ?? '')}}" class="form-control" placeholder="Enter Program Manager"/>
                @error('prog_manager')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">POC 2 </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="poc2" value="{{ old('poc2', $row->travelBoarding->poc2 ?? '')}}" class="form-control" placeholder="Enter POC 2"/>
                @error('poc2')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Title </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select class="form-control form-control-lg form-control-solid selectpicker" name="salutation" tabindex="null">
                    <option value="">Select</option>
                    <option value="Mr" {{ old('salutation') == 'Mr' || (isset($row->travelBoarding->salutation) && $row->travelBoarding->salutation == 'Mr') ? 'selected' : '' }}>Mr</option>
                    <option value="Ms" {{ old('salutation') == 'Ms' || (isset($row->travelBoarding->salutation) && $row->travelBoarding->salutation == 'Ms') ? 'selected' : ''  }}>Ms</option>
                    <option value="Mrs" {{ old('salutation') == 'Mrs' || (isset($row->travelBoarding->salutation) && $row->travelBoarding->salutation == 'Mrs') ? 'selected' : ''  }}>Mrs</option>
                </select>
                @error('salutation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Traveller Name As Per Gov. ID  </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="name" value="{{ old('name', $row->name ?? '')}}" class="form-control" placeholder="Enter Traveller Name As Per Gov. ID" readonly/>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Age </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="age" value="{{ old('age', $row && $row->getAge() ?? '')}}" class="form-control" placeholder="Enter Age" readonly/>
                @error('age')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Contact Number </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="contact" value="{{ old('contact', $row->contact ?? '')}}" class="form-control" placeholder="Enter Contact Number" readonly/>
                @error('contact')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Email ID </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="email" value="{{ old('email', $row->email ?? '')}}" class="form-control" placeholder="Enter Email" readonly/>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Mode of Travel (onward Journey) </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select name="mode_of_travel" id="mode_of_travel" class="form-control form-control-lg form-control-custom selectpicker @error('mode_of_travel') is-invalid @enderror">
                    <option value="">Select</option>

                    @if($travelModes->count())
                        @foreach($travelModes as $travelMode)
                            <option value="{{$travelMode->name}}" {{ old('mode_of_travel', $row->travelBoarding->mode_of_travel ?? '') == $travelMode->name ? 'selected' : '' }}>{{$travelMode->name}}</option>
                        @endforeach
                    @endif

                </select>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Onward (Mention City) </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select name="onward_city_id" id="onward_city_id" class="form-control form-control-lg form-control-custom selectpicker @error('onward_city_id') is-invalid @enderror" data-live-search="true" onchange="checkOtherCity(this, 'onward-city-other')">
                    <option value="">Select</option>

                    @if($cities->count())
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" {{ old('onward_city_id', $row->travelBoarding->onward_city_id ?? '') == $city->id ? 'selected' : '' }}>{{$city->city_name}}</option>
                        @endforeach
                    @endif

                </select>
                @error('onward_city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6 onward-city-other" style="display: {{ old('onward_city_id', $row->onward_city_id ?? 0) == 7934 ? '' : 'none'; }}">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Onward (Mention City) - Other </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <input type="text" name="onward_city_other" value="{{ old('onward_city_other', $row->onward_city_other ?? '') }}" class="form-control" placeholder="Enter Onward (Mention City) - Other" />

                @error('onward_city_other')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Date of Travel </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="date_of_travel" value="{{ old('date_of_travel', $row->travelBoarding->date_of_travel ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Date of Travel" readonly />

                    @error('date_of_travel')
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
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Time to reach Goa</label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="preferred_time_to_reach_goa" value="{{ old('preferred_time_to_reach_goa', $row->travelBoarding->preferred_time_to_reach_goa ?? '') }}" class="form-control kt_timepicker" placeholder="Enter Details" readonly />

                    @error('preferred_time_to_reach_goa')
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
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Flight/Train No to Reach Goa </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="preferred_flight_train_no_to_reach_goa" value="{{ old('preferred_flight_train_no_to_reach_goa', $row->travelBoarding->preferred_flight_train_no_to_reach_goa ?? '') }}" class="form-control" placeholder="Enter Details" />
                @error('preferred_flight_train_no_to_reach_goa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return City </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select name="return_city_id" id="return_city_id" class="form-control form-control-lg form-control-custom selectpicker @error('return_city_id') is-invalid @enderror" data-live-search="true" onchange="checkOtherCity(this, 'return-city-other')">
                    <option value="">Select</option>

                    @if($cities->count())
                        @foreach($cities as $city)
                            <option value="{{$city->id}}" {{ old('return_city_id', $row->travelBoarding->return_city_id ?? '') == $city->id ? 'selected' : '' }}>{{$city->city_name}}</option>
                        @endforeach
                    @endif

                </select>
                @error('return_city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6 return-city-other" style="display: {{ old('return_city_id', $row->return_city_id ?? 0) == 7934 ? '' : 'none'; }}">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return City - Other </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <input type="text" name="return_city_other" value="{{ old('return_city_other', $row->return_city_other ?? '') }}" class="form-control" placeholder="Enter Return City - Other" />

                @error('return_city_other')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return Date </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="return_date" value="{{ old('return_date', $row->travelBoarding->return_date ?? '') }}" class="form-control kt_datepicker" placeholder="Enter Return Date" readonly />

                    @error('return_date')
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
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Time to leave Goa</label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="preferred_time_to_leave_goa" value="{{ old('preferred_time_to_leave_goa', $row->travelBoarding->preferred_time_to_leave_goa ?? '') }}" class="form-control kt_timepicker" placeholder="Enter" readonly />

                    @error('preferred_time_to_leave_goa')
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
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Flight/Train No to Leave Goa </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="preferred_flight_train_no_to_leave_goa" value="{{ old('preferred_flight_train_no_to_leave_goa', $row->travelBoarding->preferred_flight_train_no_to_leave_goa ?? '') }}" class="form-control" placeholder="Enter Details" />
                @error('preferred_flight_train_no_to_leave_goa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Excess Luggage in KGS</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="excess_luggage_in_kgs" value="{{ old('excess_luggage_in_kgs', $row->travelBoarding->excess_luggage_in_kgs ?? '') }}" class="form-control" placeholder="Enter Details" />
                @error('excess_luggage_in_kgs')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control no-summernote-editor" name="artist_remarks" id="artist_remarks" placeholder="Enter Artist Remarks" require>{{ old('artist_remarks', $row->travelBoarding->artist_remarks ?? '') }}</textarea>
                @error('artist_remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">POC Remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control no-summernote-editor" name="poc_remarks" id="poc_remarks" placeholder="Enter POC Remarks" require>{{ old('poc_remarks', $row->travelBoarding->poc_remarks ?? '') }}</textarea>
                @error('poc_remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

</div>