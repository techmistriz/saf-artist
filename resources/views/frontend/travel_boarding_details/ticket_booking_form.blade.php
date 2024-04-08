<div class="row">
    <div class="col-12">
        <h5 class="card-label">Ticket Booking</h5><hr>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Project Name </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="project_name" value="{{ old('project_name', $row->project_name ?? '')}}" class="form-control form-control-solid form-control-lg" placeholder="Enter Project Name"/>
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
                <input type="text" name="salutation" value="{{ old('salutation', $user->salutation ?? '')}}" class="form-control form-control-solid form-control-lg" placeholder="Enter Title" readonly/>
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
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Mode of Travel (onward Journey) </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select name="mode_of_travel" id="mode_of_travel" class="form-control form-control-solid form-control-lg form-control-lg form-control-custom selectpicker @error('mode_of_travel') is-invalid @enderror">
                    <option value="">Select</option>

                    @if($travelModes->count())
                        @foreach($travelModes as $travelMode)
                            <option value="{{$travelMode->name}}" {{ old('mode_of_travel', $row->mode_of_travel ?? '') == $travelMode->name ? 'selected' : '' }}>{{$travelMode->name}}</option>
                        @endforeach
                    @endif

                </select>
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
                <select name="onward_city_id" id="onward_city_id" class="form-control form-control-solid form-control-lg form-control-lg form-control-custom selectpicker @error('onward_city_id') is-invalid @enderror">
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

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">DATE of Travel </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="date_of_travel" value="{{ old('date_of_travel', $row->date_of_travel ?? '') }}" class="form-control form-control-solid form-control-lg kt_datepicker" placeholder="Enter Date of Travel" readonly />

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

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Time to reach Goa</label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="preferred_time_to_reach_goa" value="{{ old('preferred_time_to_reach_goa', $row->preferred_time_to_reach_goa ?? '') }}" class="form-control form-control-solid form-control-lg kt_timepicker" placeholder="Enter" readonly />

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

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Flight/Train No to Reach Goa </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="preferred_flight_train_no_to_reach_goa" value="{{ old('preferred_flight_train_no_to_reach_goa', $row->preferred_flight_train_no_to_reach_goa ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Details" />
                @error('preferred_flight_train_no_to_reach_goa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return City </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select name="return_city_id" id="return_city_id" class="form-control form-control-solid form-control-lg form-control-lg form-control-custom selectpicker @error('return_city_id') is-invalid @enderror">
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

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Return Date </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="return_date" value="{{ old('return_date', $row->return_date ?? '') }}" class="form-control form-control-solid form-control-lg kt_datepicker" placeholder="Enter Return Date" readonly />

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

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Time to leave Goa</label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="preferred_time_to_leave_goa" value="{{ old('preferred_time_to_leave_goa', $row->preferred_time_to_leave_goa ?? '') }}" class="form-control form-control-solid form-control-lg kt_timepicker" placeholder="Enter" readonly />

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

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Preferred Flight/Train No to Leave Goa </label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="preferred_flight_train_no_to_leave_goa" value="{{ old('preferred_flight_train_no_to_leave_goa', $row->preferred_flight_train_no_to_leave_goa ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Details" />
                @error('preferred_flight_train_no_to_leave_goa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control form-control-solid form-control-lg no-summernote-editor" name="artist_remarks" id="artist_remarks" placeholder="Enter Permanent Address">{{ old('artist_remarks', $row->artist_remarks ?? '') }}</textarea>
                @error('artist_remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>
</div>