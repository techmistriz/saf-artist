<div class="row">
    <div class="col-12">
        <h5 class="card-label">Ticket Booking</h5><hr>
    </div>

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
</div>

