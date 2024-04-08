<div class="row">
    <div class="col-12">
        <h5 class="card-label">Hotel Booking</h5><hr>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Accomodation Required</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <select class="form-control form-control-solid form-control-lg form-control-lg form-control-solid selectpicker" name="accomodation" tabindex="null">
                    <option value="">Select</option>
                    <option value="Yes" {{ old('accomodation', $row->travelBoarding->accomodation ?? '') == 'Yes' ? 'selected' : '' }}>Yes</option>
                    <option value="No" {{ old('accomodation', $row->travelBoarding->accomodation ?? '') == 'No' ? 'selected' : '' }}>No</option>
                </select>

                @error('accomodation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check In Date </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="check_in_date" id="check_in_date" value="{{ old('check_in_date', $row->travelBoarding->check_in_date ?? '') }}" class="form-control form-control-solid form-control-lg kt_datepicker" placeholder="Enter Details" readonly onchange="roomNightCalc()" />
                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>
                
                @error('check_in_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Check Out Date </label>
            <div class="col-lg-9 col-md-9 col-sm-12">

                <div class="input-group date">
                    <input type="text" name="check_out_date" id="check_out_date" value="{{ old('check_out_date', $row->travelBoarding->check_out_date ?? '') }}" class="form-control form-control-solid form-control-lg kt_datepicker" placeholder="Enter Details" readonly onchange="roomNightCalc()" />

                    <div class="input-group-append">
                        <span class="input-group-text">
                            <i class="la la-calendar-check-o"></i>
                        </span>
                    </div>
                </div>

                @error('check_out_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Total Room Nights</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <input type="text" name="total_room_nights" id="total_room_nights" value="{{ old('total_room_nights', $row->travelBoarding->total_room_nights ?? '') }}" class="form-control form-control-solid form-control-lg" placeholder="Enter Details" readonly="" />
                @error('total_room_nights')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="form-group row validated">
            <label class="col-form-label col-lg-3 col-sm-12 text-lg-left">Artist Remarks</label>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <textarea class="form-control form-control-solid form-control-lg no-summernote-editor" name="hotel_artist_remarks" id="hotel_artist_remarks" placeholder="Enter Details">{{ old('hotel_artist_remarks', $row->travelBoarding->hotel_artist_remarks ?? '') }}</textarea>
                @error('hotel_artist_remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            
            </div>
        </div>
    </div>

</div>